$(function() {
    $("#basicExample").DataTable({
        iDisplayLength: 10,
		language: {"url": "../js/datatables/French.json"}
    })
}), $(function() {
    $("#autoFill").DataTable({
        autoFill: !0,
		language: {"url": "../js/datatables/French.json"},
        iDisplayLength: 10
    })
}), $(function() {
    $("#fixedHeader").DataTable({
        fixedHeader: !0,
		language: {"url": "../js/datatables/French.json"},
        iDisplayLength: 10
    })
}), $(function() {
    $("#responsiveTable").DataTable({
        responsive: !0,
        iDisplayLength: 10,
		language: {"url": "../js/datatables/French.json"}
    })
}), $(function() {
    $("#scrollTable").DataTable({
        scrollY: "500px",
        scrollCollapse: !0,
        paging: !1,
		language: {"url": "../js/datatables/French.json"},
        iDisplayLength: 10
    })
});