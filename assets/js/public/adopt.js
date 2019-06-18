$("#dog_filters").ready(function () {
    $(this).on("change", "select", function () {
        var qs = $("#dog_filters").attr("filters");
        $("#dog_filters").trigger("submit");
    });
});