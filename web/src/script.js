let enrollmentForm = null;

function confirmEnrollment() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const course = document.getElementById("course_id").value;

    if (name === "" || email === "" || course === "") {
        alert("Моля, попълнете всички полета.");
        return false;
    }

    enrollmentForm = document.querySelector("form");
    document.getElementById("confirmModal").classList.add("show");
    return false;
}

function closeModal() {
    document.getElementById("confirmModal").classList.remove("show");
}

function submitEnrollment() {
    if (enrollmentForm) {
        enrollmentForm.submit();
    }
}

function confirmDelete() {
    return confirm("Сигурни ли сте, че искате да изтриете това записване?");
}