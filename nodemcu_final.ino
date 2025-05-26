#include <ESP8266WiFi.h>
#include <LiquidCrystal_I2C.h>
#include <WiFiManager.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

// Hapus baris berikut:
// const char* ssid = "PERPUSTAKAAN-PRESMA";
// const char* password = "presma#perpus";

const char *host = "192.168.5.136"; //bisa di rubah sesuai kebutuhan / ip local/public - pc / laptop
const int httpPort = 80; //bisa di rubah sesuai kebutuhan / port default 80

LiquidCrystal_I2C lcd = LiquidCrystal_I2C(0x27, 16, 2); 

MFRC522 rfid(2, 0);
WiFiClient client;
HTTPClient http;

const unsigned int buzzer = 15;
const int pushButton = 16;

const String secretKey = "09KOb6arkLbPBihp"; //bisa di rubah sesuai kebutuhan
const String deviceId = "98a6ab06-c118-488d-8674-0bdea4e4ccce"; //bisa di rubah sesuai kebutuhan

void wifiConnection()
{
  // Pastikan LCD sudah diinisialisasi di setup sebelum fungsi ini dipanggil

  // Tampilkan pesan koneksi WiFi di LCD
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Connect WiFi:");
  lcd.setCursor(0,1);
  lcd.print("Presensi-Setup");
  delay(1500); // Beri waktu agar pesan terbaca

    Serial.begin(2000000);

  WiFiManager wifiManager;
  if(!wifiManager.autoConnect("Presensi-Setup")) {
    Serial.println("Gagal connect, restart...");
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("WiFi Gagal");
    lcd.setCursor(0,1);
    lcd.print("Restart...");
    delay(2000);
    ESP.restart();
  }

  Serial.println("WiFi connected!");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  // Tampilkan IP address di LCD setelah berhasil connect
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("WiFi Terhubung!");
  lcd.setCursor(0,1);
  lcd.print(WiFi.localIP());
  delay(1500);
}

void setLcd() {
  lcd.begin(16,2);
  lcd.init();
  lcd.backlight();
  lcd.setCursor(2, 0);
  lcd.print("APLIKASI WEB");
  lcd.setCursor(1, 1);
  lcd.print("PRESENSI RFID.");

  delay(2000);
  lcd.clear();
  lcd.setCursor(1, 0);
  lcd.print("SILAKAN TEMPEL");
  lcd.setCursor(0, 1);
  lcd.print("KARTU RFID ANDA.");
}

void setup() {
  lcd.begin(16,2);
  lcd.init();
  lcd.backlight();

  wifiConnection();
  setLcd();
  SPI.begin();
  rfid.PCD_Init();
  pinMode(pushButton, OUTPUT);
}

void loop() {

  deviceMode();

  if(!rfid.PICC_IsNewCardPresent()) {
    return;
  }

  if(! rfid.PICC_ReadCardSerial()) {
    return;
  }

  String idTag = "";
  for(byte i = 0; i < rfid.uid.size; i++) {
    idTag += rfid.uid.uidByte[i];
  }

  Serial.println(idTag);

  storePresence(idTag);

  delay(1000);
  lcd.clear();
  lcd.setCursor(1, 0);
  lcd.print("SILAKAN TEMPEL");
  lcd.setCursor(0, 1);
  lcd.print("KARTU RFID ANDA.");
}

void toneSuccess() {
  tone(buzzer, 2000); 
  delay(1000);      
  noTone(buzzer);  
}

void toneFailed() {
  tone(buzzer, 2000); 
  delay(100);
  tone(buzzer, 1000); 
  delay(100);
  tone(buzzer, 2000); 
  delay(200);
  noTone(buzzer); 
}

void deviceMode()
{
  if(digitalRead(pushButton) == 1) {  //ditekan
    while(digitalRead(pushButton) == 1); //menahan proses sampai tombol dilepas
    if(!client.connect(host, httpPort)) {
      toneFailed();
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("CONNECTION");
      lcd.setCursor(5, 1);
      lcd.print("FAILED");
      Serial.println("connection failed");
      return;
    }
    //bisa di rubah sesuai kebutuhan / url api
    String url = "http://192.168.5.136/presensi/public/api/devices/mode?secret_key=" + secretKey + "&device_id=" + deviceId;
    http.begin(client, url.c_str());

    int httpResponseCode = http.GET();

    if (httpResponseCode > 0) {
      String payload = http.getString();

      if(payload == "SECRET_KEY_NOT_FOUND") {
        toneFailed();
        lcd.clear();
        lcd.setCursor(3, 0);
        lcd.print("SECRET-KEY");
        lcd.setCursor(2, 1);
        lcd.print("TIDAK SESUAI");
      }

      if(payload == "DEVICE_NOT_FOUND") {
        toneFailed();
        lcd.clear();
        lcd.setCursor(3, 0);
        lcd.print("DEVICE-ID");
        lcd.setCursor(2, 1);
        lcd.print("TIDAK SESUAI");
      }

      if(payload == "CARD_ADD_MODE" || payload == "READER_MODE") {
        toneSuccess();
        lcd.clear();
        lcd.setCursor(1, 0);
        lcd.print("DEVICE CHANGED");
        if(payload == "READER_MODE") {
          lcd.setCursor(2, 1);
          lcd.print("READER MODE.");
        } else {
          lcd.setCursor(1, 1);
          lcd.print("ADD CARD MODE.");
        }
      }
      
    } else {
      toneFailed();
      Serial.printf("[HTTP] ... failed, error: %s\n", http.errorToString(httpResponseCode).c_str());
    }

    http.end();
  }
}

void storePresence(String rfid)
{
  if(!client.connect(host, httpPort)) {
    toneFailed();
    lcd.clear();
    lcd.setCursor(3, 0);
    lcd.print("CONNECTION");
    lcd.setCursor(5, 1);
    lcd.print("FAILED");
    Serial.println("connection failed");
    return;
  }
//bisa di rubah sesuai kebutuhan / url api
  String url = "http://192.168.5.136/presensi/public/api/presences/store?secret_key=" + secretKey + "&device_id=" + deviceId + "&rfid=" + rfid;
  http.begin(client, url.c_str());

  int httpResponseCode = http.GET();
  if (httpResponseCode > 0) {
    String payload = http.getString();

    Serial.printf("[HTTP] ... code: %d\n", httpResponseCode);
    Serial.println(payload);

    if(payload == "RFID_REGISTERED") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("KODE RFID SUKSES");
      lcd.setCursor(2, 1);
      lcd.print("DI DAFTARKAN");
      toneSuccess();
    }

    if(payload == "PRESENCE_CLOCK_IN_SAVED") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("PROSES CLOCK IN");
      lcd.setCursor(1, 1);
      lcd.print("ANDA BERHASIL.");\
      toneSuccess();
    }

    if(payload == "PRESENCE_CLOCK_OUT_SAVED") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("   HATI HATI");
      lcd.setCursor(1, 1);
      lcd.print("  DIJALAN ;>.");
      toneSuccess();
    }

    if(payload == "SECRET_KEY_NOT_FOUND") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("SECRET-KEY");
      lcd.setCursor(2, 1);
      lcd.print("TIDAK SESUAI");
      toneFailed();
    }

    if(payload == "DEVICE_NOT_FOUND") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("DEVICE-ID");
      lcd.setCursor(2, 1);
      lcd.print("TIDAK SESUAI");
      toneFailed();
    }

    if(payload == "RFID_NOT_FOUND") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("RFID ANDA");
      lcd.setCursor(0, 1);
      lcd.print("TIDAK TERDAFTAR.");
      toneFailed();
    }
  } else {
    toneFailed();
    Serial.printf("[HTTP] ... failed, error: %s\n", http.errorToString(httpResponseCode).c_str());
  }

  http.end();
}