@include('dash.head')
@include('dash.nav')
@include('dash.header')

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Dashboard</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/main">Home</a></li>
                    <li class="breadcrumb-item active">Refferals</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-body collapse show">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <h4 class="card-title">Refferals </h4>
                <div class="mt-3">
                  
                </div>
            </div>
        </div>

    
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title m-b-0">All Users</h4>
                          
                        </div>
                        
        
                    </div>
                    <div class="card-body collapse show">
                      <div class="table-responsive">
                          <table class="table product-overview">
                              <thead>
                                  <tr>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Referrals</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($users as $user)
                                  <tr>
                                      <td>{{ $user['name'] }}</td>
                                      <td>{{ $user['email'] }}</td>
                                      <td>
                                          @if (count($user['referrals']) > 0)
                                              <ul>
                                                  @foreach ($user['referrals'] as $referral)
                                                  <li>{{ $referral['name'] }} - {{ $referral['email'] }}</li>
                                                  @endforeach
                                              </ul>
                                          @else
                                              No referrals
                                          @endif
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
                  
                  
                </div>
            </div>
        </div>
    </div>
    <!-- End Container fluid  -->
</div>





@include('dash.footer')

<script>
    $(document).ready(function () {
        $('#exportrBtn').click(function () {
            var csv = [];
            var rows = $('.table tbody tr');
            rows.each(function (index, row) {
                var rowData = [];
                // Exclude the last column (Action) from each row
                $(row).find('td:not(:last-child)').each(function (index, column) {
                    rowData.push($(column).text());
                });
                csv.push(rowData.join(','));
            });
            downloadCSV(csv.join('\n'), '(Userdata).csv');
        });

        function downloadCSV(csv, filename) {
            var csvFile;
            var downloadLink;

            // CSV file
            csvFile = new Blob([csv], { type: 'text/csv' });

            // Download link
            downloadLink = document.createElement('a');

            // File name
            downloadLink.download = filename;

            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Hide download link
            downloadLink.style.display = 'none';

            // Add the link to DOM
            document.body.appendChild(downloadLink);

            // Click download link
            downloadLink.click();
        }
    });
</script>
