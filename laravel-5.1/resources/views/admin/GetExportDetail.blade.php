@if (Cookie::get('ms_lang') == null)
  <?php
    $language = 'en';
  ?>
@else
  <?php
    $language = Cookie::get('ms_lang');
  ?>
@endif

@if ($language == 'id')
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">
      <div class="row">
        <div class="col-md-12">
          <div class="box-header with-border">
            <h3 class="box-title">Lakukan Ekspor</h3>
          </div>

          <table id="table_3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Jenis Data</th>
                <th>Ekspor PDF</th>
                <th>Ekspor XLSX</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Daftar Akun</td>
                <td><a href="/resources/export/pdf/AccountList" target="_blank">Lakukan Ekspor</a></td>
                <td><a href="/resources/export/xlsx/AccountList" target="_blank">Lakukan Ekspor</a></td>
              </tr>
              <tr>
                <td>Daftar Pegawai</td>
                <!--
                <td><a href="/resources/export/pdf/EmployeeList" target="_blank">Lakukan Ekspor</a></td>
                -->
                <td>Lakukan Ekspor</td>
                <td><a href="/resources/export/xlsx/EmployeeList" target="_blank">Lakukan Ekspor</a></td>
              </tr>
              <tr>
                <td>Daftar Insiden / Kecelakaan</td>
                <td><a href="/resources/export/pdf/IncidentList" target="_blank">Lakukan Ekspor</a></td>
                <td><a href="/resources/export/xlsx/IncidentList" target="_blank">Lakukan Ekspor</a></td>
              </tr>
              <tr>
                <td>Daftar Cuti</td>
                <td><a href="/resources/export/pdf/BreakList" target="_blank">Lakukan Ekspor</a></td>
                <td><a href="/resources/export/xlsx/BreakList" target="_blank">Lakukan Ekspor</a></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>Jenis Data</th>
                <th>Ekspor PDF</th>
                <th>Ekspor XLSX</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@else
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">
      <div class="row">
        <div class="col-md-12">
          <div class="box-header with-border">
            <h3 class="box-title">Exports</h3>
          </div>

          <table id="table_3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Data</th>
                <th>PDF Export</th>
                <th>XLSX Export</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>List of Account</td>
                <td><a href="/resources/export/pdf/AccountList" target="_blank">Export</a></td>
                <td><a href="/resources/export/xlsx/AccountList" target="_blank">Export</a></td>
              </tr>
              <tr>
                <td>List of Employee</td>
                <!--
                <td><a href="/resources/export/pdf/EmployeeList" target="_blank">Lakukan Ekspor</a></td>
                -->
                <td>Export</td>
                <td><a href="/resources/export/xlsx/EmployeeList" target="_blank">Export</a></td>
              </tr>
              <tr>
                <td>List of Incident / Accident</td>
                <td><a href="/resources/export/pdf/IncidentList" target="_blank">Export</a></td>
                <td><a href="/resources/export/xlsx/IncidentList" target="_blank">Export</a></td>
              </tr>
              <tr>
                <td>List of Break Request</td>
                <td><a href="/resources/export/pdf/BreakList" target="_blank">Export</a></td>
                <td><a href="/resources/export/xlsx/BreakList" target="_blank">Export</a></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>Data</th>
                <th>PDF Export</th>
                <th>XLSX Export</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
