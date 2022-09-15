$(function () {

    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('[data-double-click="copy"]').on("dblclick", (e) => {
        const text = e.target.innerText;
        navigator.clipboard.writeText(text).then(() => {
            // on successful clipboard copy, update DOM
            e.target.innerHTML = "Copiado";
            setTimeout(() => e.target.innerText = text, 1000);
        });
    })
});