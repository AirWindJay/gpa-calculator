@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    GPA Calculator - Erwin Urbien
                </div>
                <div class="card-body">
                    <form id="gpa-form">
                        @for($i = 0; $i < 4; $i++)
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Class {{ $i + 1 }}</label>
                                <input type="text" name="class[]" class="form-control" placeholder="Enter class name">
                            </div>
                            <div class="col-md-4">
                                <label>Grade</label>
                                <select name="grades[]" class="form-control">
                                    <option value=""></option>
                                    <option value="4.0">A</option>
                                    <option value="3.7">A-</option>
                                    <option value="3.3">B+</option>
                                    <option value="3.0">B</option>
                                    <option value="2.7">B-</option>
                                    <option value="2.3">C+</option>
                                    <option value="2.0">C</option>
                                    <option value="1.7">C-</option>
                                    <option value="1.0">D</option>
                                    <option value="0.0">F</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Credits</label>
                                <input type="number" name="credits[]" class="form-control" placeholder="Enter credits" min="0">
                            </div>
                        </div>
                        @endfor

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-primary" id="calculateGpa">Calculate GPA</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <h4>Your GPA: <span id="gpa-result">0.00</span></h4>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#calculateGpa').on('click', function() {
            let totalPoints = 0;
            let totalCredits = 0;

            $('select[name="grades[]"]').each(function(index) {
                let gradeValue = parseFloat($(this).val());
                let creditValue = parseFloat($('input[name="credits[]"]').eq(index).val()) || 0;

                totalPoints += gradeValue * creditValue;
                totalCredits += creditValue;
            });

            let gpa = totalCredits > 0 ? (totalPoints / totalCredits).toFixed(2) : 0.00;
            $('#gpa-result').text(gpa);
        });
    });
</script>
@endsection
