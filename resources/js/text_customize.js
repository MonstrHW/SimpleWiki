import { emmitEvent, registerEventListener } from "./helpers";
import { onAddSection } from "./section_actions";

const mapClassTagType = {
    ".text-customize-bold": "bold",
    ".text-customize-italic": "italic",
    ".text-customize-article": "article",
};

for (const [classType, tagType] of Object.entries(mapClassTagType)) {
    document.querySelectorAll(classType).forEach((e) => {
        e.addEventListener("click", addCustomTag.bind(this, tagType));
    });
}

onAddSection((e) => {
    for (const [classType, tagType] of Object.entries(mapClassTagType)) {
        e.detail.section
            .querySelector(classType)
            .addEventListener("click", addCustomTag.bind(this, tagType));
    }
});

function surroundByTag(string, tagType) {
    switch (tagType) {
        case "bold": {
            return `[b]${string}[/b]`;
        }
        case "italic": {
            return `[i]${string}[/i]`;
        }
        case "article": {
            return `[a=]${string}[/a]`;
        }
    }

    return string;
}

export function onAddCustomTag(callback) {
    registerEventListener("onAddCustomTag", callback);
}

function addCustomTag(tagType) {
    const selection = document.getSelection();

    const elementWithSelection =
        selection.anchorNode.childNodes[selection.anchorOffset];

    if (elementWithSelection === undefined) {
        return;
    }

    const formattedString = surroundByTag(selection.toString(), tagType);

    const fullText = elementWithSelection.value;
    const selectionStart = elementWithSelection.selectionStart;
    const selectionEnd = elementWithSelection.selectionEnd;

    elementWithSelection.value =
        fullText.substr(0, selectionStart) +
        formattedString +
        fullText.substr(selectionEnd, fullText.length);

    emmitEvent("onAddCustomTag", { element: elementWithSelection });
}
