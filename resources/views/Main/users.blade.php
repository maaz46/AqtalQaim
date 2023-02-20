@extends('Main.Layout.layout')

@section('MainSection')

<h2 style="color:black;">USER RIGHTS</h2>


<div class="about1">
      <div class="container">
            <div class="row">

                  <div class="col-md-12">
                        <div class="buttton">
                              <button class=bet>New</button>
                              <button class=bet>Save</button>
                              <button class=bet>Cancel</button>
                        </div>
                  </div>
            </div>
      </div>
</div>

<div class="about2">
      <div class="container">
            <div class="row">

                  <div class="col-md-6" style="">
                        <div class="form">
                              <label class="weight" style="margin-right:118px;">Name</label>
                              <input type="text" name="text" class="Maintype"><br>

                              <label class="weight" style="margin-right:82px;">Username</label>
                              <input type="text" name="text" class="Maintype">

                              <br>

                              <label class="weight" style="margin-right:85px;">Password</label>
                              <input type="password" name="Password" class="Maintype">
                              <br>

                              <label class="weight" style="margin-right:20px;">Confirm Password</label>
                              <input type="password" name="Password" class="Maintype">
                              <br>
                              <label class="weight" style="margin-right:120px;">Email</label>
                              <input type="email" name="text" class="Maintype">
                              <br>
                              <label class="weight" style="margin-right:132px;">Cell</label>
                              <input type="tel" name="number" class="Maintype">
                              <br>
                              <div class="sel">
                                    <label class="weight" style="margin-right:88px;">Block Y/N</label>
                                    <select id="Project Category" placeholder="Project Category" class="Maintype"
                                          style="color: white;">
                                          <option value="year">Year</option>
                                          <option value="2000">2000</option>
                                          <option value="2000">2001</option>
                                          <option value="2000">2002</option>
                                          <option value="2000">2003</option>
                                          <option value="2000">2004</option>
                                          <option value="2000">2005</option>
                                          <option value="2000">2006</option>
                                          <option value="2000">2007</option>
                                          <option value="2000">2008</option>
                                          <option value="2000">2009</option>
                                          <option value="2000">2010</option>
                                          <option value="2000">2011</option>
                                          <option value="2000">2012</option>
                                          <option value="2000">2013</option>
                                          <option value="2000">2014</option>
                                          <option value="2000">2015</option>
                                          <option value="2000">2016</option>
                                          <option value="2000">2017</option>
                                          <option value="2000">2018</option>
                                          <option value="2000">2019</option>
                                          <option value="2000">2020</option>
                                          <option value="2000">2021</option>
                                          <option value="2000">2022</option>
                                          <option value="2000">2023</option>


                                    </select>
                              </div>

                              <div class="sel">
                                    <label class="weight" style="margin-right:30px;">Can Change Year</label>
                                    <select id="Year" placeholder="Year" class="Maintype" style="color: white;">
                                          <option value="year">Year</option>
                                          <option value="2000">2000</option>
                                          <option value="2000">2001</option>
                                          <option value="2000">2002</option>
                                          <option value="2000">2003</option>
                                          <option value="2000">2004</option>
                                          <option value="2000">2005</option>
                                          <option value="2000">2006</option>
                                          <option value="2000">2007</option>
                                          <option value="2000">2008</option>
                                          <option value="2000">2009</option>
                                          <option value="2000">2010</option>
                                          <option value="2000">2011</option>
                                          <option value="2000">2012</option>
                                          <option value="2000">2013</option>
                                          <option value="2000">2014</option>
                                          <option value="2000">2015</option>
                                          <option value="2000">2016</option>
                                          <option value="2000">2017</option>
                                          <option value="2000">2018</option>
                                          <option value="2000">2019</option>
                                          <option value="2000">2020</option>
                                          <option value="2000">2021</option>
                                          <option value="2000">2022</option>
                                          <option value="2023">2023</option>


                                    </select>
                              </div>


                        </div>

                  </div>

                  <div class="col-md-6" style="padding-left: 65px; border-left:2px solid;" id="col1">
                        <div class="form-check">

                              @php
                              if(count($pages)>0):
                              foreach($pages as $key=>$item):
                              @endphp
                              <input class="form-check-input" type="checkbox" value="" id="CBPage_{{$item->page_id}}"
                                    style="margin-top: 1.0rem;">
                              <label class="form-check-label" for="CBPage_{{$item->page_id}}"
                                    style="margin-right: 50px;">
                                    {{$item->page_name}}</label>
                              <select id="Year" placeholder="Year" class="Maintype1" style="color: white;">
                                    @foreach($roles as $key=>$roleitem)
                                    <option value="{{$roleitem->role_id}}">{{$roleitem->role_name}}</option>
                                    @endforeach
                              </select>
                              <br>
                              @php
                              endforeach;
                              endif;
                              @endphp





                        </div>


                  </div>
            </div>
      </div>
</div>

<table id="RoleTable" class="table">
      <thead class="thead-dark">
            <th>User Name</th>
            <th>Role Name</th>
            <th>Project Name</th>
            <th class="size"></th>
            <th class="size"></th>
      </thead>
      <tbody>
            @php
            if(count($users)>0):
            foreach($users as $key=>$item):
            @endphp
            <tr>
                  <td>{{$item->user_name}}</td>
                  <td>{{$item->role_name}}</td>
                  <td>{{$item->project_name}}</td>
                  <td style="text-align:center;">
                        <a href="/EditUser/{{$item->user_id}}"><i class="far fa-edit" style="font-size:24px;"></i></a>
                  </td>
                  <td style="text-align:center;"><a href="/DeleteUser/{{$item->user_id}}"><i class="fas fa-trash-alt"
                                    style="font-size:24px;"></i></a></td>
            </tr>
            @php
            endforeach;
            endif;
            @endphp
      </tbody>
</table>

@endsection
@section('IndividualScript')
<script>
  $('#RoleTable').DataTable();
</script>
@endsection