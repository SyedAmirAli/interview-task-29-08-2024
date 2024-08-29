export const notification = (
    title = "Your work has been saved",
    icon = "success",
    timer = 5000
) =>
    Swal.fire({
        toast: true,
        position: "top-end",
        icon: icon || "Welcome...",
        title: title || "success",
        timer: timer || 5000,
        showConfirmButton: false,
        showCloseButton: true,
        closeButtonHtml: "&times;", // Customize the close button (e.g., using a different icon or text)
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

export const notificationWrong = (text = null) =>
    notification(text || "Something went wrong!", "warning");

export const makeAlert = async (title = null, text = null, icon = null) => {
    const result = await Swal.fire({
        title: title || "Are you sure?",
        text: text || "You won't be able to revert this!",
        icon: icon || "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    });

    return result.isConfirmed;
};

export const axiosCatchErrorNotify = (error) => {
    if (typeof error?.message === "string" && error?.status !== 422) {
        notification(error?.message, "error");
        return 0;
    }

    if (typeof error?.response?.data?.message === "string") {
        notification(error.response.data?.message, "error");
        return 0;
    }

    notificationWrong();
    return 0;
};
