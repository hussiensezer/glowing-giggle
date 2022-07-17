<?php

namespace App\Http\Controllers\Dashboard\Measurement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Measurement\MeasurementStoreRequest;
use App\Http\Requests\Dashboard\Measurement\MeasurementUpdateRequest;
use App\Models\Measurement;
use App\Services\Measurement\MeasurementService;


class MeasurementController extends Controller
{
    private MeasurementService $measurementService;

    public function __construct(MeasurementService $measurementService) {
        $this->measurementService = $measurementService;
    }// End Construct

    public function index()
    {
        $measurements = $this->measurementService->Measurements();
        return view('dashboard.admin.measurement.index', compact('measurements'));
    }// End Index


    public function store(MeasurementStoreRequest $request) :object
    {
        return $this->measurementService->storeMeasurement($request);
    }// End Store

    public function update(MeasurementUpdateRequest $request , Measurement $measurement) :object
    {
            return $this->measurementService->updateMeasurement($request, $measurement);
    }// End Update


}
