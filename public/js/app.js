function updateView(){
    var week_view = document.getElementById('week_view');
    var all_task_view = document.getElementById('all_task_view');
    var view_button  = document.getElementById('view_button');

    if(week_view.classList.contains('show')){
        week_view.classList.remove('show');
        week_view.classList.add('hide');
        all_task_view.classList.remove('hide');
        all_task_view.classList.add('show');
        view_button.innerText = 'Show Tasks By Week';
    }
    else if(week_view.classList.contains('hide')){
        week_view.classList.remove('hide');
        week_view.classList.add('show');
        all_task_view.classList.remove('show');
        all_task_view.classList.add('hide');
        view_button.innerText = 'Show All Tasks';
    }


}

function findCustomer(){
    var val = document.getElementById('search_field').value;
    $.ajax({
        type: "GET",
        url: "/find",
        data: {'val': val},
        // dataType: 'String', 
        success: function (response) {
            console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        },
    });
}