let promiseGetUnit = new Promise(function (myResolve) {
    $.ajax({
        url: 'getUnitList.php', // Replace with your API endpoint
        method: 'GET',
        success: function (response) {
            if (response) {
                myResolve(response);
            }
            else {
            }
        },

        error: function (jqXHR, textStatus, errorThrown) {
            // document.getElementById('username').innerHTML="";
        }
    });
});
function enlist(arr) {
    arr.forEach(item => {
        $('#list_unit').append(`
            <tr>
                <td><a href="ADMIN-computer_details.html#`+ item.nama + `">` + item.nama + `</a></td>
                <td id="unit_count_`+ item.id + `"></td>
                <td><a href="#" class="delete_details" data-id="`+ item.id + `" onclick="return false;">Padam</a></td>
            </tr>`);
        getPCcount(item.id);
    });
}

function loadModal() {
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("tambahunit");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
loadModal();
function getPCcount(target) {
    const countCellName = '#unit_count_' + target;
    $.ajax({
        url: 'countUnitPC.php?t=' + target, // Replace with your API endpoint
        success: function (response) {
            if (response != "") { // use "response" for single variable 
                // or use "item = JSON.parse(response)" for multiple variable
                // let item =  JSON.parse(response);
                $(countCellName).html(response);
            }
            else {
                $(countCellName).html("0");
            }
        },

        error: function (jqXHR, textStatus, errorThrown) {
            // document.getElementById('username').innerHTML="";
        }
    });
}