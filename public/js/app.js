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