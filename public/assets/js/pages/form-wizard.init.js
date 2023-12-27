document.querySelector("#profile-img-file-input").addEventListener("change", function () {
    var e = document.querySelector(".user-profile-image"),
        t = document.querySelector(".profile-img-file-input").files[0],
        o = new FileReader();
    o.addEventListener(
        "load",
        function () {
            e.src = o.result;
        },
        !1
    ),
        t && o.readAsDataURL(t);
})
    
