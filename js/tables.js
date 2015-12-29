$(document).ready(function(){
    $('#tampiluser').dataTable({
        "lengthMenu": [[5, 20, 50, -1], [2, 20, 50, "Semua"]],
        "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0,1,2,3] }]//ini adalah kolom" yang di sorting
    });
    $('#tampilpembuat').dataTable({
        "lengthMenu": [[7, 20, 50, -1], [2, 20, 50, "Semua"]],
        "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0,1,2,3,4,5] }]
    });
    $('#filterberita').dataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Semua"]]
    });

    $('#tampilgaji').dataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Semua"]]
    });

    $('#filtergaji').dataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Semua"]]
    });
    $('#detailgaji').dataTable({
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Semua"]]
    });
});