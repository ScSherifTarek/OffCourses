function confirmDelete(delUrl) {
    if (confirm("Are you sure you want to delete ?")) {
        document.location = delUrl;
    }
}
function goTo(url)
{
    document.location = url;
}

function deleteOrGo(delUrl, url) {
    if (confirm("Do you want to remove this ?")) {
        document.location = delUrl;
    }
    else
    {
    	document.location = url;
    }
}