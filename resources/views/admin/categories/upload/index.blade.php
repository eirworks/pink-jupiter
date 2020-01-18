@extends('layouts.admin')

@section('title')
    Upload Kategori Layanan
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>

        <div class="card">
            <div class="card-body">
                <div class="mb-2 alert alert-info">
                    File harus berupa CSV, dengan ukuran berkas maksimum 5MB.
                </div>

                <form action="{{ route('admin.categories.upload.store') }}"
                      method="post"
                      enctype="multipart/form-data"
                >
                    @csrf

                    <div class="form-group">
                        <label>Berkas</label>
                        <input type="file" class="form-control-file" name="csv">
                    </div>

                    <button class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body">
                <h3>Panduan Upload</h3>

                <dl>
                    <dt>Bagaimana cara membuat file CSV?</dt>
                    <dd>
                        File CSV bisa dibuat dengan menggunakan aplikasi spreadsheet seperti Microsoft Excel, LibreOffice Calc, dsb.
                        Setelah memasukkan data, simpan data sebagai <code>.csv</code>.
                        <br>
                        <strong>Tips:</strong> Ketika sedang melakukan pengeditan
                        pada aplikasi Office, jangan memberikan format apapun (seperti mata uang, border tabel, warna teks, dll) pada cell.
                    </dd>
                    <dt>Bagaimana format file CSV?</dt>
                    <dd>
                        Format file csv adalah sebagai berikut:

                        <table class="table table-responsive-md">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Induk</th>
                                <th>Nama Kategori</th>
                                <th>Urutan</th>
                                <th>Grup</th>
                                <th>Harga</th>
                            </tr>
                            </thead>
                        </table>

                        Keterangan: <br>

                        <ul>
                            <li>
                                <strong>ID</strong> (wajib): ID/Indeks berupa digit yang dibutuhkan oleh sebuah
                                kategori layanan. ID bersifat unik, tidak boleh digunakan lagi di kategori lain.
                                Tidak perlu urut dan bisa diloncati.
                                Maksimal ID 5000000 (5 juta).
                                <br>
                                ID tidak boleh mengandung apapun selain angka dan tidak boleh diawali dengan 0 (otomatis diabaikan).
                            </li>
                            <li><strong>ID Induk</strong> (default 0): ID/Indeks dari induk yang dibutuhkan oleh subkategori. Isi 0 untuk kategori induk.</li>
                            <li><strong>Nama Kategori</strong> (wajib): Nama dari kategori atau sub kategori.</li>
                            <li><strong>Urutan</strong> (default 0): Nomor urut yang digunakan untuk mengurutkan kategori.</li>
                            <li><strong>Grup</strong> (default 0): Nomor id yang digunakan untuk mengelompokkan kategori ke dalam grup.</li>
                            <li><strong>Harga</strong> (default 0): Harga layanan per klik. Beri nilai 0 untuk kategori induk.</li>
                            <li>Kategori induk tidak dapat dipilih</li>
                        </ul>
                    </dd>
                </dl>

                <h4>Contoh</h4>

                <div class="row">
                    <div class="col-md-7">
                        <h5>Data di CSV</h5>
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Induk</th>
                                <th>Nama Kategori</th>
                                <th>Urutan</th>
                                <th>Grup</th>
                                <th>Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>0</td>
                                <td>Servis</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>50</td>
                                <td>0</td>
                                <td>Kursus</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>1</td>
                                <td>Servis TV</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>1</td>
                                <td>Servis AC</td>
                                <td>2</td>
                                <td>1</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>1</td>
                                <td>Servis Radio</td>
                                <td>3</td>
                                <td>1</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>1</td>
                                <td>Servis Solar Panel</td>
                                <td>2</td>
                                <td>2</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>1</td>
                                <td>Servis Water Heater</td>
                                <td>1</td>
                                <td>2</td>
                                <td>1000</td>
                            </tr>

                            <tr>
                                <td>8</td>
                                <td>50</td>
                                <td>Kursus Bahasa Mandarin</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>50</td>
                                <td>Kursus Tata Boga</td>
                                <td>1</td>
                                <td>2</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>50</td>
                                <td>Kursus Bahasa Inggris</td>
                                <td>2</td>
                                <td>1</td>
                                <td>1000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <h5>Hasil render</h5>
                        <ul>
                            <li>
                                <strong>Servis</strong>

                                <ul class="my-2">
                                    <li>Servis TV</li>
                                    <li>Servis AC</li>
                                    <li>Servis Radio</li>
                                </ul>

                                <ul class="my-2">
                                    <li>Servis Water Heater</li>
                                    <li>Servis Solar Panel</li>
                                </ul>
                            </li>
                            <li>
                                <strong>Kursus</strong>

                                <ul class="my-2">
                                    <li>Kursus Bahasa Mandarin</li>
                                    <li>Kursus Bahasa Inggris</li>
                                </ul>

                                <ul class="my-2">
                                    <li>Kursus Tata Boga</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

