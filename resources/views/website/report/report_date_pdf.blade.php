<html>
  <head>
    <title>Presence Report {{ $date->format('d F Y') }}</title>
    <style>
      table {
        border-collapse: collapse;
        font-size:12px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      table td {
        padding:5px; 
      }
      table th {
        padding:5px; 
      }

      .title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align:center;
      }

      p {
        font-size:14px;
      }
    </style>
  </head>
  <body>
    <img src="assets/dist/img/no_image.jpg" alt="" width="100px" style="position: absolute; margin-top:-20px;">
    <div class="title">
      <h2>Eduthings.com</h2>
      <p>Jl. Cigebar No 4 RT02/RW02 Desa Bojongsari Kec. Bojongsoang Kab.Bandung, Jawabarat 40288</p>
      <p>No Telp: 0812-1212-6043 Email: me.eduthings@gmail.com</p>
    </div>
    <hr>
    <div class="title">
      <h3>Presence Report</h3>
      <p>Date : {{ $date->format('d F Y') }}</p>
    </div>
    <table width="100%" border="1">
      <thead>
        <tr style="background-color:rgb(255, 192,0);">
          <th>NO</th>
          <th width="20%">Name</th>
          <th>Department</th>
          <th>Position</th>
          <th>Date</th>
          <th>Clock In</th>
          <th>Clock Out</th>
          <th>Work Duration</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($presences as $index => $presence)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{  $presence->staff->name }}</td>
            <td>{{ $presence->staff->department->name }}</td>
            <td>{{ $presence->staff->position->name }}</td>
            <td>{{ $presence->date }}</td>
            <td>{{ empty($presence->clock_in) ? '-' : $presence->clock_in }}</td>
            <td>{{ empty($presence->clock_out) ? '-' : $presence->clock_out }}</td>
            <td>{{ $presence->work_duration }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>