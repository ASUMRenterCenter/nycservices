<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<nav id="sidebar">
    <div class="sidebar-header p-10">
        <div class="form-group" style="margin: 0;">
        <!--begin::Form-->
            <div class="mb-5">
                <div class="input-search">
                    <i class="input-search-icon md-search" aria-hidden="true"></i>
                    <input type="text" class="form-control search-form" name="search" placeholder="Search for Projects" id="search_address">
                </div>
            </div>
        </div>
    </div>

       <ul class="list-unstyled components pt-0">    
                    
            <li class="option-side">
                <a href="#projectcategory" class="text-side" data-toggle="collapse" aria-expanded="false">Category</a>
                <ul class="collapse list-unstyled option-ul" id="projectcategory">
                    @foreach($taxonomies as $taxonomy)
                        
                        <li class="option-li">{{$taxonomy->taxonomy_name}}</li>
                       
                    @endforeach
                </ul>
            </li>
            <li class="option-side">
                <a href="#cityagency" class="text-side" data-toggle="collapse" aria-expanded="false">Organization</a>
                <ul class="collapse list-unstyled option-ul" id="cityagency">
                    @foreach($organizations as $organization)
                        
                        <li class="option-li">{{$organization->organization_name}}</li>
                       
                    @endforeach
                </ul>
            </li>
        </ul>

</nav>
@if(isset($location) == TRUE)
    <input type="hidden" name="location" id="location" value="{{$location}}">
@else
    <input type="hidden" name="location" id="location" value="">
@endif

<script>

$(function () {
    var getData = function (request, response) {
        $.getJSON(
            "https://geosearch.planninglabs.nyc/v1/autocomplete?text=" + request.term,
            function (data) {
                response(data.features);
                
                var label = new Object();
                for(i = 0; i < data.features.length; i++)
                    label[i] = data.features[i].properties.label;
                response(label);
            });
    };
 
    var selectItem = function (event, ui) {
        $("#location").val(ui.item.value);
        return false;
    }
 
    $("#location").autocomplete({
        source: getData,
        select: selectItem,
        minLength: 2,
        change: function() {
            console.log(selectItem);

        }
    });

    $('.ui-menu').click(function(){
        $('#search_location').submit();
    });

  
});
</script>
