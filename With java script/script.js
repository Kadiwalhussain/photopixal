document.addEventListener("DOMContentLoaded", function () {
    const photoInput = document.getElementById("photoInput");
    const resizeButton = document.getElementById("resizeButton");
    const resultDiv = document.getElementById("result");
    const downloadLink = document.getElementById("downloadLink");

    resizeButton.addEventListener("click", function () {
        if (photoInput.files.length > 0) {
            const file = photoInput.files[0];
            const formData = new FormData();
            formData.append("photo", file);
up
            fetch("resize.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                downloadLink.href = url;
                downloadLink.style.display = "block";
                downloadLink.download = "resized_photo.png";
                resultDiv.style.display = "block";
            })
            .catch(error => console.error("Error:", error));
        }
    });
});
