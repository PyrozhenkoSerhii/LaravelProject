@extends('profile/mainPageProfile')
@section('contentThird')
    <div class="container" style="width: 50%;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default settings">
                    <p><h4 align="center">Select the categories for which you want to enable the newsletter</h4></p>
                    <br>
                    <form>
                        <div class="container" style="width: 100%;">
                            <div style="width: 50%; float:left;">

                                @if(in_array("Nature", $subscriptions))
                                    <input type="checkbox" class="checkbox" id="Nature" checked onclick="checkSubscribe('Nature')"/>
                                @else
                                    <input type="checkbox" class="checkbox" id="Nature" onclick="checkSubscribe('Nature')"/>
                                @endif
                                <label for="Nature">Nature</label>
                                <br><br>

                                @if(in_array("Policy", $subscriptions))
                                    <input type="checkbox" class="checkbox" id="Policy" checked onclick="checkSubscribe('Policy')"/>
                                @else
                                    <input type="checkbox" class="checkbox" id="Policy" onclick="checkSubscribe('Policy')"/>
                                @endif
                                <label for="Policy">Policy</label>
                                <br><br>

                                @if(in_array("Sport", $subscriptions))
                                    <input type="checkbox" class="checkbox" id="Sport" checked onclick="checkSubscribe('Sport')"/>
                                @else
                                    <input type="checkbox" class="checkbox" id="Sport" onclick="checkSubscribe('Sport')"/>
                                @endif
                                <label for="Sport">Sport</label>
                                <br><br>

                            </div>
                            <div style="width: 50%; float:left; ">

                                @if(in_array("Fashion", $subscriptions))
                                    <input type="checkbox" class="checkbox" id="Fashion" checked onclick="checkSubscribe('Fashion')"/>
                                @else
                                    <input type="checkbox" class="checkbox" id="Fashion" onclick="checkSubscribe('Fashion')"/>
                                @endif
                                <label for="Fashion">Fashion</label>
                                <br><br>

                                @if(in_array("Cars", $subscriptions))
                                    <input type="checkbox" class="checkbox" id="Cars" checked onclick="checkSubscribe('Cars')"/>
                                @else
                                    <input type="checkbox" class="checkbox" id="Cars" onclick="checkSubscribe('Cars')"/>
                                @endif
                                <label for="Cars">Cars</label>
                                <br><br>

                                @if(in_array("World", $subscriptions))
                                    <input type="checkbox" class="checkbox" id="World" checked onclick="checkSubscribe('World')"/>
                                @else
                                    <input type="checkbox" class="checkbox" id="World" onclick="checkSubscribe('World')"/>
                                @endif
                                <label for="World">World</label>
                                <br><br>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkSubscribe(category){
            var deal = 'subscribe';
            switch (category) {
                case 'Nature':
                    if(!($('#Nature').is(':checked'))) {
                        deal = 'unsubscribe';
                    }
                    break;
                case 'Policy':
                    if(!($('#Policy').is(':checked'))) {
                        deal = 'unsubscribe';
                    }
                    break;
                case 'Sport':
                    if(!($('#Sport').is(':checked'))) {
                        deal = 'unsubscribe';
                    }
                    break;
                case 'Fashion':
                    if(!($('#Fashion').is(':checked'))) {
                        deal = 'unsubscribe';
                    }
                    break;
                case 'Cars':
                    if(!($('#Cars').is(':checked'))) {
                        deal = 'unsubscribe';
                    }
                    break;
                case 'World':
                    if(!($('#World').is(':checked'))) {
                        deal = 'unsubscribe';
                    }
                    break;
            }


            $.ajax({
                type:'POST',
                url:'http://whatshappened/public/showSubscribes/edit',
                data: {category:category,deal:deal,_token: CSRF_TOKEN},
                dataType: 'json',
                success:function(data) {
//                    alert("success "+category+" "+ deal);
                }
            });



        }
    </script>

@stop