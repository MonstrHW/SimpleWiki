import { onAddCustomTag } from "./text_customize";

document.querySelectorAll("textarea").forEach((element) => {
    updateTextAreaSize(element);

    element.addEventListener("input", (event) =>
        updateTextAreaSize(event.target)
    );
});

onAddCustomTag((event) => {
    const element = event.detail.element;

    if (element.tagName !== "TEXTAREA") {
        return;
    }

    updateTextAreaSize(element);
});

function updateTextAreaSize(textArea) {
    textArea.style.resize = "none";
    textArea.style.overflow = "hidden";

    textArea.style.height = "auto";
    textArea.style.height = textArea.scrollHeight + "px";
}
