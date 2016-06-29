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
                <td>Daftar Pegawait</td>
                <td><a href="/resources/export/pdf/EmployeeList" target="_blank">Lakukan Ekspor</a></td>
                <td><a href="/resources/export/xlsx/EmployeeList" target="_blank">Lakukan Ekspor</a></td>
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
                <td>Employee List</td>
                <td><a href="/resources/export/pdf/EmployeeList" target="_blank">Export</a></td>
                <td><a href="/resources/export/xlsx/EmployeeList" target="_blank">Export</a></td>
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
