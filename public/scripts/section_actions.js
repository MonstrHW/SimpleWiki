function clearSection(section) {
    section.querySelector("input").value = "";
    section.querySelector("textarea").value = "";

    section.querySelectorAll("span").forEach((e) => e.remove());

    section
        .querySelector("div.border")
        .classList.replace("border-red-600", "border-gray-500");
}

function getElementOfSection(sectionID) {
    return document.getElementById("section" + sectionID);
}

function updateSectionIndexes() {
    let sections = document.querySelectorAll("#sections>[id^='section']");

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

function getSectionsCount() {
    return document.querySelectorAll("#sections>[id^='section']").length;
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
    if (getSectionsCount() <= 1) {
        return;
    }

    const section = getElementOfSection(from);
    section.remove();

    updateSectionIndexes();
}

function addSection(from) {
    const section = getElementOfSection(from);

    const newSection = section.cloneNode(true);
    clearSection(newSection);
    section.after(newSection);

    updateSectionIndexes();
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
