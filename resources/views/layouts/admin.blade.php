<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">

    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- ✅ Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Page Title  -->
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Autres feuilles de style personnalisées -->
    @include('_partials.stylesheet')
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('_partials.sidebar')
            <!-- sidebar @e -->

            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('_partials.header')
                <!-- main header @e -->

                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->

                <!-- footer @s -->
                @include('_partials.footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- Modales -->
    @yield('modal')

    <!-- ✅ Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts supplémentaires -->
    @include('_partials.script')
    @stack('scripts')
</body>

</html>
