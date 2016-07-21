<div style="overflow-y: scroll;">
  <table id="table_1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>NIP</th>
        <th>UID</th>
        <th>Full Name</th>
        <th>branch</th>
        <th>jenis_jabatan_nama</th>
        <th>jenis_divisi_nama</th>
        <?php
          $day = 1;
          while ($day <= $days) {
            echo '<th>'.$day.'</th>';
            $day++;
          }
        ?>
      </tr>
    </thead>
    <tbody>
      @if (empty($results))
      <tr>
        <th>Empty</th>
        <th>Empty</th>
        <th>Empty</th>
        <th>Empty</th>
        <th>Empty</th>
        <th>Empty</th>
        <?php
          $day = 1;
          while ($day <= $days) {
            echo '<th>Empty</th>';
            $day++;
          }
        ?>
      </tr>
      @else
      @foreach ($results as $result)
      <tr>
        <th>{{ $result->nip }}</th>
        <th>{{ $result->uid }}</th>
        <th>{{ $result->nama_lengkap }}</th>
        <th>{{ $result->branch }}</th>
        <th>{{ $result->jenis_jabatan_nama }}</th>
        <th>{{ $result->jenis_divisi_nama }}</th>
        <?php
          $day = 1;
          while ($day <= $days) {
            if ($result->$day == 0)
              echo '<th style="background-color: #DEDD9C;">-</th>';
            else if ($result->$day == 1)
              echo '<th style="background-color: #CD906A;">O</th>';
            else if ($result->$day == 2)
              echo '<th style="background-color: #94D8DB;">C</th>';
            else if ($result->$day == 3)
              echo '<th style="background-color: #C085D6;">P</th>';
            else if ($result->$day == 4)
              echo '<th style="background-color: #EAC9ED;">S</th>';
            else if ($result->$day == 5)
              echo '<th style="background-color: #AFE4B0;">M</th>';
            else
              echo '<th style="background-color: black;">-</th>';
            $day++;
          }
        ?>
      </tr>
      @endforeach
      @endif
    </tbody>
    <tfoot>
      <tr>
        <th>NIP</th>
        <th>UID</th>
        <th>Full Name</th>
        <th>branch</th>
        <th>jenis_jabatan_nama</th>
        <th>jenis_divisi_nama</th>
        <?php
          $day = 1;
          while ($day <= $days) {
            echo '<th>'.$day.'</th>';
            $day++;
          }
        ?>
      </tr>
    </tfoot>
  </table>

  <script src="{{ asset('/LTEAdmin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/LTEAdmin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/bootbox/bootbox.min.js') }}"></script>
  <script>
    $(function () {
      $("#table_1").DataTable();
    });
  </script>
</div>
