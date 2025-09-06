<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        const BASE_URL = "{{ url('/') }}"; // Outputs like: http://localhost:8000
    </script>

    <style>
        /* Contain Summernote styles within the editor container */
        .note-editor {
            border-radius: 0.5rem !important;
            border: 1px solid #d1d5db !important;
            overflow: hidden;
            margin-top: 0 !important;
        }

        .note-editor .note-toolbar {
            background-color: #f3f4f6 !important;
            border-bottom: 1px solid #d1d5db !important;
            padding: 0.5rem !important;
        }

        .note-editor .note-editable {
            min-height: 200px;
            padding: 1rem !important;
            background-color: white !important;
        }

        /* Fix dropdown z-index issue */
        .note-dropdown-menu {
            z-index: 100 !important;
        }

        /* Fix button styling */
        .note-btn {
            background-color: transparent !important;
            border: 1px solid #d1d5db !important;
            border-radius: 0.25rem !important;
            padding: 0.25rem 0.5rem !important;
            margin: 0 2px !important;
        }

        .note-btn:hover {
            background-color: #e5e7eb !important;
        }

        /* Fix color picker styling */

        .note-color-palette {
            width: 160px !important;
        }

        .note-color-palette div {
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
        }

       
        
        #DataTables_Table_0_wrapper{
            font-family: poppins !important;

        }

        .dataTables_filter {
            margin-bottom: 18px !important;
            font-family: poppins;
        }
        

        .dataTables_filter input {
            padding: 0.5rem 1rem !important;   
            border: 1px solid #D1D5DB !important;
            border-radius: 8px !important;
            outline: none !important;
        }

        .dataTables_filter input:focus {
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5) !important;
           
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class=" bg-gray-50 font-headingfont ">
        {{-- Sidebar --}}
        <div class=" overflow-hidden">
            @include('admin.pages.layout.sidebar')
        </div>
        <div class="flex-1 ml-[0px] md:ml-[250px] flex flex-col h-screen">
            @include('admin.pages.layout.header')
            <div class="flex-1 overflow-y-auto p-6 bg-gray-100">
                @yield('content')
            </div>
        </div>
    </div>
    {{-- @include('admin.pages.layout.footer') --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>


    <!-- ✅ jQuery (Required by Summernote) -->

    <!-- ✅ Summernote Lite CSS -->

    <!-- ✅ Summernote Lite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        toastr.options = {
            preventDuplicates: true,
        }
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 1000;
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':

                    toastr.options.timeOut = 1000;
                    toastr.success("{{ Session::get('message') }}");

                    break;
                case 'warning':

                    toastr.options.timeOut = 1000;
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':

                    toastr.options.timeOut = 1000;
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

    
    @stack('scripts')

</body>

</html>
