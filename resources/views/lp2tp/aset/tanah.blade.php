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

    </style>

    <section class="asset-dashboard">
        <div class="container">
            <h2 class="heading" style="margin-top: 40px;">Aset - Tanah</h1>
            <hr>
            
            <div class="d-flex align-items-center justify-content-between">
                <form class="w-75 d-flex align-items-center gap-2 mb-3">
                       <!-- Filter Section -->
                    <div class="filter-container">
                        <select id="bpsip" placeholder="BPTP">
                            <option value="">BPTP</option>
                            <option value="aceh">Aceh</option>
                            <option value="sumut">Sumatera Utara</option>
                            <option value="sumbar">Sumatera Barat</option>
                            <option value="riau">Riau</option>
                            <option value="kepri">Kepulauan Riau</option>
                            <option value="jambi">Jambi</option>
                            <option value="sumsel">Sumatera Selatan</option>
                            <option value="bengkulu">Bengkulu</option>
                            <option value="babel">Bangka Belitung</option>
                            <option value="lampung">Lampung</option>
                            <option value="banten">Banten</option>
                            <option value="jakarta">DKI Jakarta</option>
                            <option value="jabar">Jawa Barat</option>
                            <option value="jateng">Jawa Tengah</option>
                            <option value="yogyakarta">Yogyakarta</option>
                            <option value="jatim">Jawa Timur</option>
                            <option value="kalbar">Kalimantan Barat</option>
                            <option value="kalteng">Kalimantan Tengah</option>
                            <option value="kaltim">Kalimantan Timur</option>
                            <option value="kalsel">Kalimantan Selatan</option>
                            <option value="bali">Bali</option>
                            <option value="ntb">Nusa Tenggara Barat</option>
                            <option value="ntt">Nusa Tenggara Timur</option>
                            <option value="sulut">Sulawesi Utara</option>
                            <option value="gorontalo">Gorontalo</option>
                            <option value="sulteng">Sulawesi Tengah</option>
                            <option value="sultra">Sulawesi Tenggara</option>
                            <option value="sulsel">Sulawesi Selatan</option>
                            <option value="sulbar">Sulawesi Barat</option>
                            <option value="malut">Maluku Utara</option>
                            <option value="maluku">Maluku</option>
                            <option value="papbar">Papua Barat</option>
                            <option value="papua">Papua</option>
                        </select>
                        
                        <button type="submit" class="btn btn-success">Cari</button>
                    </div>
                  </form>
                  
                <div class="d-flex align-items center justify-content-end gap-2 w-50">
                    <a  class="btn btn-success">
                        <i class="fa-solid fa-file-excel"></i>&ensp;
                        Import Excel
                    </a>
                </div>
            </div>

        <p>Pendataan Sarana dan Prasarana Berupa Tanah</p>

            <!-- Table with Static Data -->
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>BPTP</th>
                            <th>Nama KP</th>
                            <th>Jenis Aset</th>
                            <th>Luas Lahan (m<sup>2</sup>)</th>
                            <th>Tahun Perolehan</th>
                            <th>Bukti Kepemilikan</th>
                            <th>Nomor Sertifikat</th>
                            <th>Penanggung Jawab Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Aceh</td>
                            <td>KP. Gayo</td>
                            <td>Tanah Bangunan Kantor Pemerintahan</td>
                            <td>1300,5</td>
                            <td>2008</td>
                            <td>Sertifikat Hak Pakai No.03 Tanggal 14 Januari 2013</td>
                            <td>47847765252</td>
                            <td>Muspitawati,S.AP</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Papua</td>
                            <td>KP. Gayo</td>
                            <td>Tanah Bangunan Kantor Pemerintahan</td>
                            <td>11,00</td>
                            <td>2014</td>
                            <td>Sertifikat Hak Pakai No.03 Tanggal 14 Januari 2013</td>
                            <td>47847765252</td>
                            <td>Muspitawati,S.AP</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Aceh</td>
                            <td>KP. Gayo</td>
                            <td>Tanah Bangunan Kantor Pemerintahan</td>
                            <td>11,00</td>
                            <td>2013</td>
                            <td>Sertifikat Hak Pakai No.03 Tanggal 14 Januari 2013</td>
                            <td>47847765252</td>
                            <td>Muspitawati,S.AP</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Papua</td>
                            <td>KP. Gayo</td>
                            <td>Tanah Bangunan Kantor Pemerintahan</td>
                            <td>11,00</td>
                            <td>2013</td>
                            <td>Sertifikat Hak Pakai No.03 Tanggal 14 Januari 2013</td>
                            <td>47847765252</td>
                            <td>Muspitawati,S.AP</td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Aceh</td>
                            <td>KP. Gayo</td>
                            <td>Tanah Bangunan Kantor Pemerintahan</td>
                            <td>11,00</td>
                            <td>2013</td>
                            <td>Sertifikat Hak Pakai No.03 Tanggal 14 Januari 2013</td>
                            <td>47847765252</td>
                            <td>Muspitawati,S.AP</td>
                        </tr>
                    </tbody>
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
