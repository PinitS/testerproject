@extends('layouts.master')

@section('pagetitle' , 'Index')

@section('content')



  <div class="card pnt-card">
    <div class="card-header"><strong>Credit Card</strong> <small>Form</small></div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control pint-input-name" id="name" type="text" placeholder="Enter your name">
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
            <input class="form-control pint-input-ccv" id="cvv" type="text" placeholder="123" disabled>
          </div>
        </div>
      </div>
      <!-- /.row-->
    </div>
  </div>




  <div class="mt-5 card text-white bg-primary text-center pnt-fix" style="position: fixed; top: 55px; right: 10px; z-index: 1000; display: none">
    <div class="card-body">
      <blockquote class="card-bodyquote">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
        <footer>Someone famous in
          <cite title="Source Title">Source Title</cite>
          <button type="button" style="display: none" class="btn btn-lg btn-danger pnt-btn-in-card" >hide</button>
        </footer>
      </blockquote>
    </div>
  </div>


  <button type="button"  class="btn btn-lg btn-danger pnt-btn-out-card" style="position: fixed; top: 80px; right: 10px;" >Order</button>


  <div class="row">
    <div class="col-sm-3">
      <input type="hidden" class ="pnt-text-value" value="#sweet ">
      <button type="button"  class="btn btn-lg btn-danger mb-2 pnt-add-text1" data-value="" >1</button>
    </div>

    <div class="col-sm-3">
      <button type="button"  class="btn btn-lg btn-danger mb-2 pnt-add-text2" >2</button>
    </div>

    <div class="col-sm-3">
      <button type="button"  class="btn btn-lg btn-danger mb-2 pnt-add-text3" >3</button>
    </div>

    <div class="col-sm-3">
      <button type="button"  class="btn btn-lg btn-danger mb-2 pnt-add-text4" >4</button>
    </div>

  </div>

  <div class="row">
    <div class="col-12">
      <input class="form-control pnt-input-text" id="name" type="text" placeholder="Enter your name">
    </div>
  </div>



  


@endsection

@section('script')
  <script>
let text = "";
// $('.pnt-add-text1').click(function()
//   {
//     g += "g ";
//     $('.pnt-input-text').val();
//     console.log(g);
//   }
      
// );

@foreach($hashtags as $hashtag)
$('.pnt-add-text{!! $hashtag->id !!}').click(function()
  {
    text += $('.pnt-text-value').val();
    $('.pnt-input-text').val(text);
  } 
);
@endforeach

$('.pnt-add-text2').click(function()
  {
    text += "#text2 ";
    $('.pnt-input-text').val(text);
  } 
);

$('.pnt-add-text3').click(function()
  {
    text += "#text3 ";
    $('.pnt-input-text').val(text);
  } 
);

$('.pnt-add-text4').click(function()
  {
    text += "#text4 ";
    $('.pnt-input-text').val(text);
  } 
);



$('.pnt-btn-out-card').click(function()
      {
        $('.pnt-fix').show();
        $('.pnt-btn-out-card').hide();
        $('.pnt-btn-in-card').show();
      }
  );

$('.pnt-btn-in-card').click(function()
      {
        $('.pnt-fix').hide();
        $('.pnt-btn-out-card').show();
        $('.pnt-btn-in-card').hide();
      }
  );

    

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


    $('.pint-input-name').keyup(function()
      {
        var Values = $('.pint-input-name').val();
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








