 // Define a function to handle the click event
 function handleDeleteClick(event) {
    event.preventDefault(); // Prevent the default action (following the link)

    // Show Swal confirmation dialog
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, redirect to the delete action URL
            window.location.href = event.target.getAttribute('href');
        }
    });
}

// Add click event listener to delete links
document.querySelectorAll('.delete-link').forEach(link => {
    link.addEventListener('click', handleDeleteClick);
});

function handleAcceptClick(event) {
    event.preventDefault(); // Prevent the default action (following the link)

    // Show Swal confirmation dialog
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Accept it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, redirect to the delete action URL
            window.location.href = event.target.getAttribute('href');
        }
    });
}

// Add click event listener to delete links
document.querySelectorAll('.accept-link').forEach(link => {
    link.addEventListener('click', handleAcceptClick);
});

function handleRefuseClick(event) {
    event.preventDefault(); // Prevent the default action (following the link)

    // Show Swal confirmation dialog
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Refuse it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, redirect to the delete action URL
            window.location.href = event.target.getAttribute('href');
        }
    });
}

// Add click event listener to delete links
document.querySelectorAll('.refuse-link').forEach(link => {
    link.addEventListener('click', handleRefuseClick);
});
