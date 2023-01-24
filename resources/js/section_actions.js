import { emmitEvent, registerEventListener } from "./helpers";

updateSectionIndexes();

function clearSection(section) {
    section.querySelector("input").value = "";

    let textArea = section.querySelector("textarea");
    textArea.value = "";
    textArea.style.height = "auto";

    section.querySelectorAll("span.error").forEach((e) => e.remove());

    section
        .querySelector("div.border")
        .classList.replace("border-red-600", "border-gray-700");
}

function getElementOfSection(sectionID) {
    return document.getElementById("section" + sectionID);
}

function updateSectionIndexes() {
    let sections = getSections();

    for (let i = 0; i < sections.length; i++) {
        let section = sections[i];

        section.id = "section" + i;

        section.querySelector("input").name = `sections[${i}][header]`;
        section.querySelector("textarea").name = `sections[${i}][body]`;

        section.querySelector("#delete").onclick = deleteSection.bind(this, i);
        section.querySelector("#up").onclick = moveUpSection.bind(this, i);
        section.querySelector("#down").onclick = moveDownSection.bind(this, i);
        section.querySelector("#add").onclick = addSection.bind(this, i);
    }
}

function getSections() {
    return document.querySelectorAll("#sections>[id^='section']");
}

function getSectionsCount() {
    return getSections().length;
}

function moveSection(from, target, before) {
    let fromSection = getElementOfSection(from);
    let targetSection = getElementOfSection(target);
    let tempSection = targetSection.cloneNode(true);

    targetSection.replaceWith(fromSection);

    if (before) {
        fromSection.before(tempSection);
    } else {
        fromSection.after(tempSection);
    }
}

function deleteSection(from) {
    const section = getElementOfSection(from);

    if (getSectionsCount() == 1) {
        clearSection(section);

        return;
    }

    section.remove();

    updateSectionIndexes();
}

export function onAddSection(callback) {
    registerEventListener("onAddSection", callback);
}

function addSection(from) {
    const section = getElementOfSection(from);

    const newSection = section.cloneNode(true);
    clearSection(newSection);
    section.after(newSection);

    updateSectionIndexes();

    emmitEvent("onAddSection", { section: newSection });
}

function moveUpSection(from) {
    let sectionsCount = getSectionsCount();

    if (sectionsCount <= 1) {
        return;
    }

    let targetID = from - 1;
    let isSideSection = from == 0;

    if (isSideSection) {
        targetID = sectionsCount - 1;
    }

    moveSection(from, targetID, isSideSection);

    updateSectionIndexes();
}

function moveDownSection(from) {
    let sectionsCount = getSectionsCount();

    if (sectionsCount <= 1) {
        return;
    }

    let targetID = from + 1;
    let isSideSection = targetID >= sectionsCount;

    if (isSideSection) {
        targetID = 0;
    }

    moveSection(from, targetID, !isSideSection);

    updateSectionIndexes();
}
