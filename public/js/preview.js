<script>
var $ = document;

$.addEventListener('DOMContentLoaded', function(){
    $.querySelector("[name='imagefile']").addEventListener('change', function(e) {
        var file = e.target.files[0],
            reader = new FileReader(),
            $preview = $.querySelector(".preview"),
            t = this;

            reader.onload = (function(file) {
                return function(e) {
                    while ($preview.firstChild) $preview.removeChild($preview.firstChild);

                    var img = document.createElement("img");
                    img.setAttribute('src', e.target.result);
                    img.setAttribute('title', file.name);
                    $preview.appendChild(img);
                };
            })(file);

            reader.readAsDataURL(file);
    });
});
</script>