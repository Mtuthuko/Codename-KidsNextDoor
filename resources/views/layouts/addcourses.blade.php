<div class="courseCodes" >
    <div style="background-color: #0B3865;color:white;border: 1px solid black; padding:5px;border:2px solid white">
        Course Codes
    </div>
    <div>
        <table class="table table-bordered">
            <tr>
              <th>Coursecode</th>
              <th>Course Name</th>
            </tr>
    
            @foreach($posts as $post)
              <tr>
                <td>{{$post['code']}}</td>
                <td>{{$post['name']}}</td>
              </tr>
            @endforeach
          </table> 
    </div>
</div>