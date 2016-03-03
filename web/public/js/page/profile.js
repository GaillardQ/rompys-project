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

    $("#table-user-games").tablesorter({
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
            '.photo, .state, .update, .delete' : {
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
            },

        }
    });/*
    .tablesorterPager({

        // target the pager markup - see the HTML block below
        container: $(".ts-pager"),

        // target the pager page select dropdown - choose a page
        cssGoto: ".pagenum",

        // remove rows from the table to speed up the sort of large tables.
        // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
        removeRows: false,

        // output string - default is '{page}/{totalPages}';
        // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

    });*/
    $("#table-user-games .tablesorter-filter-row td:nth-child(2)").addClass("hidden-xs");
    $("#table-user-games .tablesorter-filter-row td:nth-child(3)").addClass("hidden-xs");
    $("#table-user-games .tablesorter-filter-row td:nth-child(4)").addClass("hidden-xs");
    $("#table-user-games .tablesorter-filter-row td:nth-child(5)").addClass("hidden-xs hidden-sm");
    $("#table-user-games .tablesorter-filter-row td:nth-child(6)").addClass("hidden-xs");
    $("#table-user-games .tablesorter-filter-row td:nth-child(7)").addClass("visible-lg");
    $("#table-user-games .tablesorter-filter-row td:nth-child(8)").addClass("visible-lg");
    $("#table-user-games .tablesorter-filter-row td:nth-child(9)").addClass("visible-lg");
    
    $('[data-toggle="popover"]').popover();
    
});

function deleteGameCatalog(id, hash)
{
    $.ajax({
        url : "/ws/game_catalog/"+id+"/delete/"+hash,
        dataType : 'json', // on spécifie bien que le type de données est en JSON
        data : {
            id : id
        },
        success : function(data){
            location.reload();
        }
    });
}

function displayProfileGameCard(_id, _path)
{
	$.ajax({
        url : _path,
        dataType : 'json', // on spécifie bien que le type de données est en JSON
        data : {
            id : _id
        },
        success : function(data){
            $("#card-loader").hide();
            $("#card-data").show();
            
            var game = data.game[0];
            
            var photos = "";
            if(game.image_1 != null)
            {
                photos += "<div><img class=\"card-img img-responsive img-rounded\" src=\"/rompy/web/pictures/"+game.game_id+"/"+game.image_1+"\" class=\"img-rounded\" /></div>";     
            }
            if(game.image_2 != null)
            {
                photos += "<div><img class=\"card-img img-responsive img-rounded\" src=\"/rompy/web/pictures/"+game.game_id+"/"+game.image_2+"\" class=\"img-rounded\" /></div>";     
            }
            if(game.image_3 != null)
            {
                photos += "<div><img class=\"card-img img-responsive img-rounded\" src=\"/rompy/web/pictures/"+game.game_id+"/"+game.image_3+"\" class=\"img-rounded\" /></div>";     
            }
            $('#card-data-photos').html(photos);
            
            $('#card-data-photos').slick();
            
            $("#card-data-name").text(game.name);
            
            $("#card-data-year").text(game.year);
            
            if(game.alternative_name != null)
                $("#card-data-name-bis").text(game.alternative_name);
            else
                $("#card-data-name-bis").hide();
                
            $("#card-data-plateform").text(game.plateform);
            
            $("#card-data-type").text(game.game_type);
            
            if(game.serie != null)
                $("#card-data-serie").text(game.serie);
            else
            {
                $("#card-data-serie").hide();
                $("#card-data-serie-label").hide();
            }
                
            var edit = "<ul>";
            if(game.editor_1 != null)
                edit += "<li>"+game.editor_1+"</li>";
            if(game.editor_2 != null)
                edit += "<li>"+game.editor_2+"</li>";
            if(game.editor_3 != null)
                edit += "<li>"+game.editor_3+"</li>";
            edit += "</ul>";
            $("#card-data-editors").html(edit);
            
            $("#card-data-language").text(game.language);
            
            if(game.game_package)
                $("#card-data-package").text("Oui");
            else
                $("#card-data-package").text("Non");
            
            if(game.blister)
                $("#card-data-blister").text("Oui");
            else
                $("#card-data-blister").text("Non");
                
            if(game.notice)
                $("#card-data-notice").text("Oui");
            else
                $("#card-data-notice").text("Non");
            
            $("#card-data-state").text(game.state);
            
            $("#card-data-zone").text(game.zone);
            
            $("#card-data-price").text(game.price+" €");
            
            if(game.comment != null)
                $("#card-data-comment").text(game.comment);
            else
                $("#card-data-comment").hide();
        },
        error : function(jqXHR, textStatus, errorThrown)
        {
            alert("Une erreur est survenue lors de la recherche des jeux, merci de re-essayer.");
        },
        timeout: 120000
    });
}

