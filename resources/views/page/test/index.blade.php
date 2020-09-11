@extends('layouts.master')

@section('pagetitle' , 'Index')

@section('content')

<div class="card">
    <div class="card-header"><strong>Credit Card</strong> <small>Form</small></div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control " id="pint-input-name" type="text" placeholder="Enter your name">
          </div>
        </div>
      </div>
      <!-- /.row-->
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="ccnumber">Credit Card Number</label>
            <input class="form-control pint-input-credit" id="ccnumber" type="text" placeholder="0000 0000 0000 0000" disabled>
          </div>
        </div>
      </div>
      <!-- /.row-->
      <div class="row">
        <div class="form-group col-sm-4">
          <label for="ccmonth">Month</label>
          <select class="form-control pint-input-month" id="ccmonth" disabled>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
          </select>
        </div>
        <div class="form-group col-sm-4">
          <label for="ccyear">Year</label>
          <select class="form-control pint-input-year" id="ccyear" disabled>
            <option>2014</option>
            <option>2015</option>
            <option>2016</option>
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
            <option>2020</option>
            <option>2021</option>
            <option>2022</option>
            <option>2023</option>
            <option>2024</option>
            <option>2025</option>
          </select>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="cvv">CVV/CVC</label>
            <input class="form-control " id="cvv" type="text" placeholder="123" disabled>
          </div>
        </div>
      </div>
      <!-- /.row-->
    </div>
  </div>


  <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>

  <label class="c-switch c-switch-label c-switch-danger">

    <input  id="roie_id_hidden" name ="role_id" class="c-switch-input pnt-chk-b" value="off" type="hidden">
    <input  id="role_id" name ="role_id" class="c-switch-input pnt-chk-b" value="on" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
</label>

<input type="radio" name="result" id="asd" value="buy" checked>
<input type="radio" name="result" id="asd" value="sell">


@endsection

@section('script')
  <script>

    $('#role_id').change(function()
      {
        if( $('#role_id').is(":checked"))
        {
          $('#roie_id').val();      
        }
        else
        {
          $('#roie_id').val(); 

        }
        //console.log("check"); 
        console.log($($('#roie_id').val());        
      }
    );

    function test() {
        if (document.getElementById('asd').checked == true) {
            alert("hello1");
        }

        if (document.getElementById('asd').checked == true) {
            alert("hello2");
        }
    }

    

    // $('.pint-input-name').keydown(function()
    //   {
    //     console.log("check keydown input name");
    //     $('.pint-input-credit').prop("disabled",false);
        
    //   }
    // );

    // $('.pint-input-credit').keyup(function()
    //   {
    //     console.log("check keydown input credit");
    //     $('.pint-input-month').prop("disabled",false);
        
    //   }
    // );


    $('#pint-input-name').keyup(function()
      {
        var Values = $('#pint-input-name').val();
        console.log(Values);
        if(Values === "")
        {
          $('.pint-input-credit').prop("disabled",true);
        }
        else
        {
          $('.pint-input-credit').prop("disabled",false);
        }
      }
    );

    $('.pint-input-credit').keyup(function()
      {
        var Values = $('.pint-input-credit').val();
        console.log(Values);
        if(Values === "")
        {
          $('.pint-input-month').prop("disabled",true);
        }
        else
        {
          $('.pint-input-month').prop("disabled",false);
        }
        
      }
    );

    

    $('.pint-input-month').change(function()
      {
        console.log("check change dropdown month");
        $('.pint-input-year').prop("disabled",false);
        
      }
    );

    $('.pint-input-year').change(function()
      {
        console.log("check change dropdown year");
        $('.pint-input-ccv').prop("disabled",false);
        
      }
    );
    
  </script>

@endsection








