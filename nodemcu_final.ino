#include <ESP8266WiFi.h>
#include <LiquidCrystal_I2C.h>
#include <MFRC522.h>
#include <WiFiManager.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WebServer.h>
#include <WiFiClientSecure.h>  // ✅ Tambahkan ini untuk HTTPS

const char *host = "presensi.vpstjkt.my.id"; // Ganti dengan domain, bukan IP
const int httpsPort = 443; // Port HTTPS default

LiquidCrystal_I2C lcd = LiquidCrystal_I2C(0x27, 16, 2); 
MFRC522 rfid(2, 0);
WiFiClientSecure clientSecure;  // ✅ Ganti ke WiFiClientSecure
HTTPClient http;

const unsigned int buzzer = 15;
const int pushButton = 16;

const String secretKey = "09KOb6arkLbPBihp";
const String deviceId = "98a6ab06-c118-488d-8674-0bdea4e4ccce";
// const String deviceId = "c6c6e194-5d3e-4e5f-95f0-38cc223cda2c";
// const String deviceId = "00b5a55d-2117-4042-9634-3885194d4302";
// const String deviceId = "1f4a6025-07a8-4a95-bd7c-2a4f685cfdb5";
// const String deviceId = "a11dd37d-f1e5-46cb-b369-b73bcf8802cb";
// const String deviceId = "74e0dd3d-208d-4aef-803f-82efcc5f3577";
// const String deviceId = "35307e1a-e8f7-4d33-b3e4-4a00f86f5a90";
// const String deviceId = "1c4dfdb4-5aa2-4682-a5d4-d0c40195c6b3";
// const String deviceId = "fcb2dbd0-0202-43d2-9701-c2e83c4719fd";
// const String deviceId = "38d78b1b-9b1c-4c1b-8c66-4c7255d61f3a";
// const String deviceId = "05a7c5e2-b1c0-40e0-bb68-9d5741fcf204";
// const String deviceId = "ad2a90d7-7b0c-4293-92bb-ec21ab700c59";
// const String deviceId = "9c99cf35-58aa-4c58-8481-38edc7aa372b";
// const String deviceId = "69cd7dc0-7423-4c20-9a1a-b7702a5d2c3f";
// const String deviceId = "79245218-85a7-48b3-8c9f-b7180a988009";
// const String deviceId = "6cf6a210-d23e-4c84-bba5-84136b2e7c76";
// const String deviceId = "5bcf6c45-3b82-4767-96b4-87725733423b";
// const String deviceId = "5b44f0c7-6bb5-4c5e-a7d2-34fa7bbd52cc";
// const String deviceId = "ee6ecfe5-e924-48c0-a7c3-00f25e5dc66f";
// const String deviceId = "f21ab001-8274-41bb-9012-52f9b3a566d3";
// const String deviceId = "389e6907-6240-4b65-9d6c-0ed26012608f";
// const String deviceId = "e494110e-f7a6-4e29-a879-dcf2bce2cf5e";
// const String deviceId = "76305bd7-4a14-4033-bd58-911c6bc0fdec";
// const String deviceId = "2a2a0c4d-6717-41b0-a0ff-6fa2545b4ea9";
// const String deviceId = "4e573ca2-1e85-4ad4-b3d0-c352c29b5d58";
// const String deviceId = "df05b90c-13e1-4424-b8a9-e11ad823998e";
// const String deviceId = "ca80d2b1-01cd-48be-a236-39fcbfa1e471";
// const String deviceId = "ed6a70cd-2e61-47cb-a586-28ecac728d34";
// const String deviceId = "74a1e982-3613-47ce-90a2-49e2f54b7721";
// const String deviceId = "97be1585-261e-4d59-8f34-62c30a2f81f6";
// const String deviceId = "f930f5e4-3741-45c2-a0e7-559b5412f1ee";
// const String deviceId = "130b302f-6de1-4d42-8bd9-fd1cfabe3e61";
// const String deviceId = "97994470-d947-4a95-9395-1e7410b9cf10";
// const String deviceId = "f46df98a-3b0a-48f5-a24a-34cf8d9a4c32";
// const String deviceId = "631d89e2-b67d-4cbf-b5e8-69424a45858b";
// const String deviceId = "e47c49a5-56f3-45f7-a879-1c22102f53f5";
// const String deviceId = "38e635b7-63ad-4b00-8929-8041cda9fc6e";
// const String deviceId = "a76831aa-1f60-4b7a-aadc-18140e68a042";
// const String deviceId = "1fd56c08-5aef-4c35-bdc5-7542a0075ff0";
// const String deviceId = "aa2cdcec-b97b-4038-89a1-2f27f5b02e2b";
// const String deviceId = "52034056-70cb-4b2f-9d16-9b9e80b8e0f6";
// const String deviceId = "0fffb31d-1cfc-4a61-9d27-70e3025b9610";
// const String deviceId = "de7d8200-70f1-44b1-8468-9a1a4ad0d63a";
// const String deviceId = "2b80e55d-5426-41a1-bdc7-37eb17894a2d";
// const String deviceId = "f3257bff-e4df-4de2-9d17-d31d3acdb1d2";
// const String deviceId = "35044d3b-3446-45aa-b1b7-8c508473d29c";
// const String deviceId = "72ea1380-5a92-4d4f-bc93-15429a4d1f69";
// const String deviceId = "58e8b9bc-df9e-45fc-b3cc-5596d0d7992c";
// const String deviceId = "bd1e2cf3-206b-4d3e-9b80-18942c62614a";
// const String deviceId = "bc164a30-882b-4de4-a803-7cb1251b28a9";
// const String deviceId = "d7fc2b06-093b-41dc-9466-33a9dfc5199e";
// const String deviceId = "0ea3ea38-3cf5-48b6-8bb7-916e4fdf60f0";
// const String deviceId = "5e97ad3e-9ed2-49d1-8f3b-4bc9e5a3d6e5";
// const String deviceId = "8b9f7494-c35d-4a5f-b8cf-c90f52f5d25f";
// const String deviceId = "e1f3267f-2cb1-42d6-baa0-57d8a511cbe4";
// const String deviceId = "79a3a72f-94eb-4646-9c65-4dc64e3dc4ef";
// const String deviceId = "b662ccfd-c4b7-4600-8cfc-e134acc06b0b";
// const String deviceId = "34b0a8cd-5791-42cd-a07b-9466d3b0e601";
// const String deviceId = "c4b6a4db-82e4-46ec-bf32-32dfbb7c73a3";
// const String deviceId = "6d99f857-9f5a-4ab0-8ed8-3a9d45ccf2be";
// const String deviceId = "aaebdc86-09b8-4f1e-a2fd-e49b902c2c16";


void wifiConnection() {
  Serial.begin(9600);
  WiFiManager wifiManager;

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Config WiFi...");
  lcd.setCursor(0, 1);
  lcd.print("Tunggu sebentar");

  wifiManager.autoConnect("Presensi_RFID");

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("WiFi Terhubung!");
  lcd.setCursor(0, 1);
  lcd.print(WiFi.localIP());

  Serial.println("Connected to WiFi");
  Serial.println(WiFi.localIP());

  delay(2000);
}

void setLcd() {
  lcd.begin(16, 2);
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
  wifiConnection();
  setLcd();
  SPI.begin();
  rfid.PCD_Init();
  pinMode(pushButton, OUTPUT);

  clientSecure.setInsecure(); // ✅ Tidak aman, tapi cukup untuk testing
}

void loop() {
  deviceMode();

  if (!rfid.PICC_IsNewCardPresent()) return;
  if (!rfid.PICC_ReadCardSerial()) return;

  String idTag = "";
  for (byte i = 0; i < rfid.uid.size; i++) {
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

void deviceMode() {
  if (digitalRead(pushButton) == 1) {
    while (digitalRead(pushButton) == 1);

    String url = "https://" + String(host) + "/api/devices/mode?secret_key=" + secretKey + "&device_id=" + deviceId;
    http.begin(clientSecure, url); // ✅ Gunakan HTTPS client

    int httpResponseCode = http.GET();
    if (httpResponseCode > 0) {
      String payload = http.getString();

      if (payload == "SECRET_KEY_NOT_FOUND") {
        toneFailed();
        lcd.clear();
        lcd.setCursor(3, 0);
        lcd.print("SECRET-KEY");
        lcd.setCursor(2, 1);
        lcd.print("TIDAK SESUAI");
      } else if (payload == "DEVICE_NOT_FOUND") {
        toneFailed();
        lcd.clear();
        lcd.setCursor(3, 0);
        lcd.print("DEVICE-ID");
        lcd.setCursor(2, 1);
        lcd.print("TIDAK SESUAI");
      } else {
        toneSuccess();
        lcd.clear();
        lcd.setCursor(1, 0);
        lcd.print("DEVICE CHANGED");
        lcd.setCursor(2, 1);
        lcd.print(payload == "READER_MODE" ? "READER MODE." : "ADD CARD MODE.");
      }
    } else {
      toneFailed();
      Serial.printf("[HTTP] failed, error: %s\n", http.errorToString(httpResponseCode).c_str());
    }
    http.end();
  }
}

void storePresence(String rfid) {
  String url = "https://" + String(host) + "/api/presences/store?secret_key=" + secretKey + "&device_id=" + deviceId + "&rfid=" + rfid;
  http.begin(clientSecure, url); // ✅ Gunakan HTTPS client

  int httpResponseCode = http.GET();
  if (httpResponseCode > 0) {
    String payload = http.getString();
    Serial.printf("[HTTP] code: %d\n", httpResponseCode);
    Serial.println(payload);

    if (payload == "RFID_REGISTERED") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("KODE RFID SUKSES");
      lcd.setCursor(2, 1);
      lcd.print("DI DAFTARKAN");
      toneSuccess();
    } else if (payload == "PRESENCE_CLOCK_IN_SAVED") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("PROSES CLOCK IN");
      lcd.setCursor(1, 1);
      lcd.print("ANDA BERHASIL.");
      toneSuccess();
    } else if (payload == "PRESENCE_CLOCK_OUT_SAVED") {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("   HATI HATI");
      lcd.setCursor(1, 1);
      lcd.print("  DIJALAN ;>.");
      toneSuccess();
    } else if (payload == "SECRET_KEY_NOT_FOUND") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("SECRET-KEY");
      lcd.setCursor(2, 1);
      lcd.print("TIDAK SESUAI");
      toneFailed();
    } else if (payload == "DEVICE_NOT_FOUND") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("DEVICE-ID");
      lcd.setCursor(2, 1);
      lcd.print("TIDAK SESUAI");
      toneFailed();
    } else if (payload == "RFID_NOT_FOUND") {
      lcd.clear();
      lcd.setCursor(3, 0);
      lcd.print("RFID ANDA");
      lcd.setCursor(0, 1);
      lcd.print("TIDAK TERDAFTAR.");
      toneFailed();
    }
  } else {
    toneFailed();
    Serial.printf("[HTTP] failed, error: %s\n", http.errorToString(httpResponseCode).c_str());
  }

  http.end();
}
