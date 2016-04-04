$(document).ready(function() {
    $.tablesorter.themes.bootstrap = {
        // these classes are added to the table. To see other table classes available,
        // look here: http://getbootstrap.com/css/#tables
        table: 'table table-bordered table-striped',
        caption: 'caption',
        // header class names
        header: 'bootstrap-header', // give the header a gradient background (theme.bootstrap_2.css)
        sortNone: '',
        sortAsc: '',
        sortDesc: '',
        active: '', // applied when column is sorted
        hover: '', // custom css required - a defined bootstrap style may not override other classes
        // icon class names
        icons: '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
        iconSortNone: 'bootstrap-icon-unsorted', // class name added to icon when column is not sorted
        iconSortAsc: 'glyphicon glyphicon-chevron-up', // class name added to icon when column has ascending sort
        iconSortDesc: 'glyphicon glyphicon-chevron-down', // class name added to icon when column has descending sort
        filterRow: '', // filter row class; use widgetOptions.filter_cssFilter for the input/select element
        footerRow: '',
        footerCells: '',
        even: '', // even row zebra striping
        odd: '' // odd row zebra striping
    };

    $("#table-all-users").tablesorter({
        // this will apply the bootstrap theme if "uitheme" widget is included
        // the widgetOptions.uitheme is no longer required to be set
        theme: "bootstrap",

        widthFixed: true,

        headerTemplate: '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

        // widget code contained in the jquery.tablesorter.widgets.js file
        // use the zebra stripe widget if you plan on hiding any rows (filter widget)
        widgets: ["uitheme", "filter", "zebra"],

        headers: {
            // disable sorting of the first & second column - before we would have to had made two entries
            // note that "first-name" is a class on the span INSIDE the first column th cell
            '.disable, .disabled' : {
                // disable it by setting the property sorter to false
                sorter: false,
                filter: false
            }
        },

        widgetOptions: {
            // using the default zebra striping class name, so it actually isn't included in the theme variable above
            // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
            zebra: ["even", "odd"],

            // reset filters button
            filter_reset: ".reset",

            // extra css class name (string or array) added to the filter element (input or select)
            filter_cssFilter: "form-control",

            filter_functions : {
            }
        }
    });
    
    $('[data-toggle="popover"]').popover();
});


function enableUser(enable, id, hash)
{
    var msg = "";
    if(enable === false)
    {
        msg = prompt("Message d'information", "");
    }
    
    $.ajax({
        url : "/ws/user/"+id+"/enable/"+enable+"/"+hash,
        dataType : 'json', // on spécifie bien que le type de données est en JSON
        method: "POST",
        data : {
            msg : msg
        },
        success : function(data){
            location.reload();
        }
    });
}