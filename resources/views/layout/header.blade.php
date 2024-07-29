<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title }} - Sistem Informasi Tesis Aswaja</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{ url('') }}/assets/img/icon-unwahas.png"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{ url('') }}/assets/js/plugin/webfont/webfont.min.js"></script>
  
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ url('') }}/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ url('') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('') }}/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ url('') }}/assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="{{ url('') }}/assets/css/style.css" />

  </head>