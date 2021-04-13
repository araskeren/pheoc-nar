<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container-fluid">
        <a href="{{ route('home.dashboard') }}" class="navbar-brand">
            <img src="{{ url('img/coronavirus.png') }}" style="width:40px;" />
            <span class="brand-text font-weight-light"><strong>COVID</strong>-19</span>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::segment(1)=='home' || Request::segment(1)=='dashboard' ? 'active' : '' }}">
                    <a href="{{ route('home.dashboard') }}" class="nav-link">Home</a>
                </li>
                @if(in_array(Session('group'), [3,13,14,15]))
                <li class="nav-item {{ Request::segment(1)=='epidemiologi' ? 'active' : '' }}">
                    <a href="{{ route('epidemiologi.weekly.index') }}" class="nav-link">Epidemiologi</a>
                </li>
                @endif
                @if(in_array(Session('group'), [10]))
                    <li class="nav-item {{ Request::segment(1)=='epidemiologi' ? 'active' : '' }}">
                        <a href="{{ route('epidemiologi.weekly.pkm.index') }}" class="nav-link">Epidemiologi</a>
                    </li>
                @endif
                @if(in_array(Session('group'),[1,4,7,12]))
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Epidemiologi <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('epidemiologi.index') }}" class="nav-link">Harian</a>
                            <a href="{{ route('epidemiologi.weekly.index') }}" class="nav-link">Mingguan</a>
                        </div>
                    </li>
                @endif
                @if (in_array(Session('group'),[1,2,3,4,6,7,10]) )
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">KASUS <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('people.index') }}" class="nav-link">KASUS</a>
{{--                            <a href="{{ route('patient.index') }}" class="nav-link">PDP</a>--}}
{{--                            @if (in_array(Session('group'),[1,3,7,10]))--}}
{{--                            <a href="{{ url('odp')  }}" class="dropdown-item" ><i>ODP</i></a>--}}
{{--                            @endif--}}
                            @if (in_array(Session('group'),[1,2,3,7,10]))
                                <a href="{{ route('allRecord.index') }}" class="nav-link">SPESIMEN</a>
                            @endif

                        </div>
                    </li>
                    @if (in_array(Session('group'),[1,2,3,6,7]))
                        <li class="nav-item {{ Request::segment(1)=='pasien' ? 'active' : '' }}">
                            <a href="{{ route('logistic.stock.index') }}" class="nav-link">Logistik</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Fasilitas <span class="caret"></span></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="{{ route('facility.index') }}" class="nav-link">Fasilitas</a>
                                <a href="{{ route('facility.sdm.index') }}" class="dropdown-item"><i>SDM</i></a>
                            </div>
                        </li>
                        {{-- <li class="nav-item {{ Request::segment(1)=='pasien' ? 'active' : '' }}">
                            <a href="{{ route('facility.index') }}" class="nav-link">Fasilitas</a>
                        </li> --}}
                    @endif
                @endif

                {{-- PUSKESMAS --}}
                @if (in_array(Session('group'),[10]) )
                    <li class="nav-item {{ Request::segment(1)=='pasien' ? 'active' : '' }}">
                        <a href="{{ route('tracing.bywil.index') }}" target="_blank" class="nav-link">Tracing</a>
                    </li>
                @endif
                {{-- PUSKESMAS --}}

                @if (in_array(Session('group'),[9, 7]))
                    <li class="nav-item {{ Request::segment(1)=='lab' ? 'active' : '' }}">
                        <a href="{{ route('lab.index') }}" class="nav-link">LAB</a>
                    </li>
                @endif
                @if (in_array(Session('group'),[1,4,7,13]))
                    <li class="nav-item {{ Request::segment(1)=='lab' ? 'active' : '' }}">
                        <a href="{{ route('satpolpp.index') }}" class="nav-link">Satpol PP</a>
                    </li>
                @endif
                @if (in_array(Session('group'),[1,3,4,7,13,14]))
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Laporan <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('report.monitoring.index') }}" class="dropdown-item">Kasus</a>
                            <a href="{{ route('report.vaccine.index') }}" class="dropdown-item">Vaksinasi</a>
                        </div>
                    </li>
                @endif
                @if (Session('group')==8)
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Berita <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('post.index') }}" class="dropdown-item">Post News</a>
                            <a href="{{ route('galleries.index') }}" class="dropdown-item">Post Galleries</a>
                            <a href="{{ route('video.index') }}" class="dropdown-item">Post Videos</a>
                            <a href="{{ route('files.index') }}" class="dropdown-item">Post Files</a>
                            <a href="{{ route('category.index') }}" class="dropdown-item">Categories</a>
                        </div>
                    </li>
                @endif

                @if (in_array(Session('group'),[5]))
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Logistik <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('logistik.index') }}" class="dropdown-item" style="color:green"><i>Logistik</i></a>
                            <a href="{{ route('logistic.stakeholder.index') }}" class="dropdown-item" style="color:green"><i>Stakeholder</i></a>
                            <a href="{{ route('logistic.stock.index') }}" class="dropdown-item" style="color:green"><i>Stock</i></a>
                        </div>
                    </li>
                @endif

                @if (in_array(Session('group'),[1, 7]))
                    {{-- Konsumsi superadmin --}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Master <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('analisis.list') }}" class="dropdown-item" style="color:violet"><i>Analisis Cepat</i></a>
                            <a href="{{ route('rumah-sakit.index') }}" class="dropdown-item" style="color:green"><i>Hospital</i></a>
                            <a href="{{ url('assessment/home') }}" class="dropdown-item" style="color:green"><i>Assessment</i></a>
                            <hr>
                            <a href="{{ route('logistic.stakeholder.index') }}" class="dropdown-item" style="color:green"><i>Logistik Stakeholder</i></a>
                            <a href="{{ route('logistic.stock.index') }}" class="dropdown-item" style="color:green"><i>Stock</i></a>
                            <hr>
                            <a href="{{ route('facility.stakeholder.index') }}" class="dropdown-item" style="color:red"><i>Fasilitas Stakeholder</i></a>
                            <a href="{{ route('facility.type.index') }}" class="dropdown-item" style="color:red"><i>Fasilitas Type</i></a>
                            <hr>
                            <a href="{{ url('users/home') }}" class="dropdown-item" style="color:green"><i>User RS</i></a>
                            <hr>
                            <a href="{{ route('unduh.index') }}" class="nav-link">Download</a>
                        </div>
                    </li>
{{--                     <li class="nav-item {{ Request::segment(1)=='public-info' ? 'active' : '' }}">--}}
{{--                        <a href="{{ url('public-info/home') }}" class="nav-link" style="color:green"><i>Public Info</i></a>--}}
{{--                    </li>--}}
                    {{-- Konsumsi superadmin --}}
                @endif

                @if (in_array(Session('group'),[1,3,4,7]))
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Tracing <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- <a target="_blank" href="{{ url('tracing') }}" class="dropdown-item" style="color:green"><i>Visualisasi</i></a> --}}
                            <a href="{{ route('tracing.resume') }}" class="dropdown-item" style="color:green"><i>Resume</i></a>
                            <a href="{{ route('tracing.report.index') }}" class="dropdown-item" ><i>Report</i></a>
                        </div>
                    </li>
                @endif

                <li class="nav-item {{ Request::segment(1)=='download' || Request::segment(1)=='download' ? 'active' : '' }}">
                    <a href="{{ route('download.user.index') }}" class="nav-link">Unduh</a>
                </li>

            </ul>
        </div>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="javascript:;">Halo, {{ @Auth::user()->nama }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pop" href="javascript:;" data-src="{{ url('change-pass') }}" data-fancybox data-type="ajax" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Ganti Password Disini"><i class="fas fa-lock"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('logout') }}"><i class="fas fa-power-off"></i></a>
            </li>
        </ul>
    </div>
</nav>
