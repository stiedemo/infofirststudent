<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Phiếu thu thập thông tin học sinh đầu khoá trực tuyến</title>
  </head>
  <body>


    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-sm-12">
                @if(session()->has('suss'))
                <div class="alert alert-success">
                    {{ session()->get('suss') }}
                </div>
                @else
                @if($userForm->public)
                <form class="mb-5" action="{{ route('write_student', $userForm->hash_code) }}" method="POST">
                    @if ($errors->any())
                    <div class="alert alert-danger">Vui lòng điền đầy đủ các trường dữ liệu có dấu nháy sao (*)</div>
                    @endif
                    @csrf
                    <fieldset>
                        <legend>{{ $userForm->name }}</legend>
                        @foreach ($userForm->UserConfigForms as $userConfigForm)
                            @php $nameInputStudent = "studentinput__" . $userConfigForm->id @endphp
                            <div class="mb-3">
                                <label for="inputStudent{{ $userConfigForm->id }}" class="form-label">{{ $userConfigForm->name }} @if($userConfigForm->required) <span class="text-danger">(*)</span> @endif</label>
                                @if($userConfigForm->type == "text")
                                <input name="{{ $nameInputStudent }}" type="text" id="inputStudent{{ $userConfigForm->id }}" value="{{ old($nameInputStudent) ? old($nameInputStudent) : $userConfigForm->default }}" class="form-control {{ $errors->has($nameInputStudent) ? 'is-invalid' : '' }}" placeholder="{{ $userConfigForm->description }}">
                                @endif
                                @if($userConfigForm->type == "date")
                                <input name="{{ $nameInputStudent }}" type="date" id="inputStudent{{ $userConfigForm->id }}" value="{{ old($nameInputStudent) ? old($nameInputStudent) : $userConfigForm->default }}" class="form-control {{ $errors->has($nameInputStudent) ? 'is-invalid' : '' }}" placeholder="{{ $userConfigForm->description }}">
                                @endif
                                @if($userConfigForm->type == "select")
                                <select class="form-select {{ $errors->has($nameInputStudent) ? 'is-invalid' : '' }}" name="{{ $nameInputStudent }}">
                                    <option value="">Lựa chọn {{ $userConfigForm->name }}</option>
                                    @foreach (json_decode($userConfigForm->config_content, true) as $index => $config_content)
                                    <option {{ old($nameInputStudent) && old($nameInputStudent) == $config_content ? "selected" : "" }} value="{{ $config_content }}">{{ $config_content }}</option>
                                    @endforeach
                                </select>
                                @endif
                                @if($userConfigForm->type == "radio")
                                @foreach (json_decode($userConfigForm->config_content, true) as $index => $config_content)
                                <div class="form-check form-check-inline">
                                    <input {{ old($nameInputStudent) && old($nameInputStudent) == $config_content ? "checked" : "" }} class="form-check-input {{ $errors->has($nameInputStudent) ? 'is-invalid' : '' }}" type="radio" name="{{ $nameInputStudent }}" id="inputStudent{{ $userConfigForm->id }}_{{$index}}" value="{{ $config_content }}">
                                    <label class="form-check-label" for="inputStudent{{ $userConfigForm->id }}_{{$index}}">{{ $config_content }}</label>
                                </div>
                                @endforeach
                                @endif
                                @if($errors->has($nameInputStudent) && $userConfigForm->type != "radio")
                                <div class="invalid-feedback">
                                    Vui lòng điền dữ liệu vào trường có dấu nháy (*)
                                </div>
                                @endif
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Hoàn thành</button>
                    </fieldset>
                </form>
                @else
                    <div class="alert alert-danger">
                        Phiếu thu thập đã tạm ngừng !
                    </div>
                @endif
                @endif
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
