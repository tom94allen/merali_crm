function updateView(){
    var week_view = document.getElementById('week_view');
    var all_task_view = document.getElementById('all_task_view');
    var view_button  = document.getElementById('view_button');
    var all_task_comment = document.getElementById('all_task_comment');

    if(week_view.classList.contains('show')){
        week_view.classList.remove('show');
        week_view.classList.add('hide');
        all_task_view.classList.remove('hide');
        all_task_view.classList.add('show');
        all_task_comment.classList.remove('hide');
        all_task_comment.classList.add('show');
        view_button.innerText = 'Show Tasks By Week';
    }
    else if(week_view.classList.contains('hide')){
        week_view.classList.remove('hide');
        week_view.classList.add('show');
        all_task_view.classList.remove('show');
        all_task_view.classList.add('hide');
        all_task_comment.classList.remove('show');
        all_task_comment.classList.add('hide');
        view_button.innerText = 'Show All Tasks';
    }


}

function customerView(){
    var main_area = document.getElementById('main-area');
    var search_area = document.getElementById('search-area');
    var view_button = document.getElementById('view_button');

    if(search_area.classList.contains('show')){
        search_area.classList.remove('show');
        search_area.classList.add('hide');
        main_area.classList.remove('hide');
        main_area.classList.add('show');
        view_button.innerText = 'Search By Customer';
    }
    else if(search_area.classList.contains('hide')){
        search_area.classList.remove('hide');
        search_area.classList.add('show');
        main_area.classList.remove('show');
        main_area.classList.add('hide');
        view_button.innerText = 'View All Customers';
    }
}

function findCustomer(){
    var val = document.getElementById('customer_search').value;
    $.ajax({
        type: "GET",
        url: "search",
        data: {'val': val}, 
        success: function (response) {
            var search_field = document.getElementById('customer_search');
            var search_result = document.getElementById('customer_result');
            search_result.style.display = "block";
            search_result.innerHTML = response;
            
            if(document.activeElement != search_field){
                search_result.style.display = "none";
            }
                
        },
        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        },
    });
}

function customerContacts(){
    var val = document.getElementById('search_field').value;
    $.ajax({
        type: "GET",
        url: "find",
        data: {'val': val},
        success: function(response){
            var search_field = document.getElementById('search_field');
            var search_result = document.getElementById('search_result');
            search_result.style.display = "block";
            search_result.innerHTML = response;
            
            if(document.activeElement != search_field){
                search_result.style.display = "none";
            }
        },
        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        },
    })
}

//used to vertically align text in center of div to line up with images
function verAlign(){
    $('#ver-align').each(function(){
        $(this).css({
            'line-height' : $(this).height() + 'px'
        });
        
    });
}

//executing the above on ready of page
$(document).ready(function(){
    verAlign();
});
