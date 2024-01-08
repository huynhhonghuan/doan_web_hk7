<footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} by ALo</strong>
</footer>
<script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/admin/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
{{-- <!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script> --}}
<script>
    $(document).ready(function() {
        new DataTable('#tablephim', {
            language: {
                info: 'Hiện thị trang _PAGE_ trên _PAGES_',
                infoEmpty: 'Không có phim nào',
                infoFiltered: '(được lọc từ tổng số _MAX_ phim)',
                lengthMenu: 'Hiện thị _MENU_ phim',
                zeroRecords: 'Không tìm thấy',
                search: 'Tìm kiếm: ',
                paginate: {
                    previous: '<<',
                    next: '>>'
                }
            },
            // scrollX: true,
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabletruyen').DataTable({
            //disable sorting on last column
            "columnDefs": [{
                "orderable": false,
                "targets": 5
            }],
            language: {
                //customize pagination prev and next buttons: use arrows instead of words
                'paginate': {
                    'previous': '<span class="fa fa-chevron-left"></span>',
                    'next': '<span class="fa fa-chevron-right"></span>'
                },
                //customize number of elements to be displayed
                "lengthMenu": 'Hiển thị <select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="-1">All</option>' +
                    '</select> số lượng',

                "zeroRecords": "Nothing found - sorry",
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_",
                "infoEmpty": "Hiển thị từ 0 đến 0 của 0",
                "search": "Tìm kiếm:",
            }
        });
    });
</script>
@yield('footer')
