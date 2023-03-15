// Retrieve the category name based on the category ID
function getCategoryName(category) {
    switch (category) {
        case "1":
            return "Vape Juice";
        case "2":
            return "Vape Mods";
        case "3":
            return "Disposable Vape";
        case "4":
            return "Cigars";
        case "5":
            return "Hookah";
        case "6":
            return "Tobacco";
        case "7":
            return "Charcoal";
        case "8":
            return "Rolling Paper";
        case "9":
            return "Accessories";
        default:
            return "All Products";
    }
}

// Retrieve the items in the category and update the HTML
function getItems(category) {
    // Send a GET request to the get-items.php file with the category parameter
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the HTML of the item-container with the response
            document.querySelector(".item-container").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "items.php?category=" + category, true);
    xhttp.send();
}

// Call the getItems function when the page loads
window.onload = function() {
    // Get the category from the URL parameters
    let searchParams = new URLSearchParams(window.location.search);
    let category = searchParams.get("category");
    // Set the category name in the heading
    let categoryName = getCategoryName(category);
    document.getElementById("category-name").textContent = categoryName;
    // Call the getItems function with the category parameter
    getItems(category);
};
