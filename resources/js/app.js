import "./bootstrap";
import "preline";

const html = document.querySelector("html");
const isLightOrAuto =
    localStorage.getItem("hs_theme") === "light" ||
    (localStorage.getItem("hs_theme") === "auto" &&
        !window.matchMedia("(prefers-color-scheme: dark)").matches);
const isDarkOrAuto =
    localStorage.getItem("hs_theme") === "dark" ||
    (localStorage.getItem("hs_theme") === "auto" &&
        window.matchMedia("(prefers-color-scheme: dark)").matches);

if (isLightOrAuto && html.classList.contains("dark"))
    html.classList.remove("dark");
else if (isDarkOrAuto && html.classList.contains("light"))
    html.classList.remove("light");
else if (isDarkOrAuto && !html.classList.contains("dark"))
    html.classList.add("dark");
else if (isLightOrAuto && !html.classList.contains("light"))
    html.classList.add("light");

document.addEventListener("livewire:navigated", () => {
    window.HSStaticMethods.autoInit();
});

document.addEventListener("DOMContentLoaded", function () {
    const fullscreenButton = document.getElementById("btn-fullscreen");

    if (fullscreenButton) {
        fullscreenButton.addEventListener("click", function () {
            toggleFullscreen();
        });
    }

    function toggleFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch((err) => {
                console.error(
                    "Error attempting to enable fullscreen mode:",
                    err
                );
            });
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen().catch((err) => {
                    console.error(
                        "Error attempting to exit fullscreen mode:",
                        err
                    );
                });
            }
        }
    }

    document.querySelectorAll('input[type-currency="IDR"]').forEach((el) => {
        el.addEventListener("keyup", function (e) {
            let cursorPosition = this.selectionStart;
            let value = parseInt(this.value.replace(/[^,\d]/g, ""));
            let originalLength = this.value.length;
            if (isNaN(value)) {
                this.value = "";
            } else {
                this.value = value.toLocaleString("id-ID", {
                    minimumFractionDigits: 0,
                    currency: "IDR",
                    style: "currency",
                });
                cursorPosition =
                    this.value.length - originalLength + cursorPosition;
                this.setSelectionRange(cursorPosition, cursorPosition);
            }
        });
    });
});
