$(function () {
    $(document).ready(function () {
        $('.clockpicker').clockpicker();
    });


    var checkMaster = $('.checkMaster');
    var masterPanel = $('#masterPanel');

    var employee;

    checkMaster.click(function () {
        employee = $(this).data("employee");
        masterPanel.hide();
        return false;
    });
});