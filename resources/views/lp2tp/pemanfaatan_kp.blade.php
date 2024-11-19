@extends('layouts.header_navbar_footer_lp2tp')

@section('content')
    <style>
        .asset-dashboard {
            background-color: #f5f5f5;
        }

        h2 {
            text-align: left;
            color: #009144;
            padding: 10px;
        }
    
        .filter-container {
            display: flex;
            margin-bottom: 20px;
        }

        .filter-container select, .filter-container input {
            padding: 8px;
            font-size: 1em;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .filter-container button {
            padding: 8px 10px;
            background-color: #00452C;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .filter-container button:hover {
            background-color: #006633;
        }
          /* New styles for export button */
        .export-button {
        float: right;
        padding: 8px 15px;
        background-color: #009144; /* Green color */
        color: white;
        border: none;
        border-radius: 5px;
        margin-left: 625px; /* Push the button to the right side */
        }

        .export-button:hover {
        background-color: #00b36b; /* Darker green on hover */
        }

        .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        }

  </style>

    <section class="asset-dashboard">
        <div class="container">
            <h2 class="heading">Pemanfaatan Kebun Percobaan</h1>
            <hr>
            

             <!-- Filter Section -->
        <div class="filter-container">
            <select id="bpsip" placeholder="BPTP">
                <option value="">BPTP</option>
                <option value="bpsip1">Aceh</option>
                <option value="bpsip2">Papua</option>
                <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
            </select>
        </div>

        <div class="d-flex align-items-center justify-content-between">
            <form class="w-75 d-flex align-items-center gap-2 mb-3">
                <input type="search" name="nama kp" id="cari" class="form-control w-25" placeholder="Cari Nama KP">
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
            </form>
            <div class="d-flex align-items center justify-content-end gap-2 w-50">
                <a  class="btn btn-success">
                    <i class="fa-solid fa-file-excel"></i>&ensp;
                    Import Excel
                </a>
            </div>
        </div>

        <p>Pendataan Pemanfaatan Kebun Percobaan</p>

            <!-- Table with Static Data -->
            <div class="table-container">
                <table class="table table-bordered">
                    <tr>
                      <th>NO</th>
                      <th>BPTP/KP</th>
                      <th>LUAS KP (Ha)</th>
                      <th>JML SDM (ORG)</th>
                      <th>ARGO EKOSISTEM</th>
                      <th>BANGUNAN</th>
                      <th>LUAS (Ha)</th>
                      <th>PENGKAJIAN/ DISEMINASI</th>
                      <th>LUAS (Ha)</th>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>BPTP Aceh KP. Gayo</td>
                      <td>18,88</td>
                      <td>13</td>
                      <td>Lahan Kering Dataran Tinggi</td>
                      <td>1. Kantor<br>2. Mess dan rumah<br>3. Lain-lain</td>
                      <td>0,47<br>0,35<br>0,1</td>
                      <td>1. Pengkajian<br>2. Plasma Nutfah<br>3. Kebun Produksi<br>4. Visitor Plot</td>
                      <td>0,9<br>14,18<br>0,8<br>3</td>
                    </tr>
                  </table>

                <nav aria-label="...">
                    <ul class="pagination">
                      <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                      </li>
                      <li class="page-item active" aria-current="page">
                        <span class="page-link">1</span>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                      </li>
                    </ul>
                  </nav>
            </div>


        </div>
    </section>
    
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
