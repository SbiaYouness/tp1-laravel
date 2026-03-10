<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Loan;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::all();

        return response()->json([
            'data' => $loans,
            'message' => 'Loans retrieved successfully',
            'count' => $loans->count(),
        ], 200);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'borrower_email' => 'required|email|max:255',
            'book_title' => 'required|string|max:255',
            'borrowed_at' => 'nullable|date',
            'due_date' => 'nullable|date|after:borrowed_at',
            'returned' => 'sometimes|boolean',
            'status' => 'sometimes|in:active,returned,overdue',  
        ]);

        // Convert ISO 8601 to MySQL DATETIME format if present
        if (isset($validated['borrowed_at'])) {
            $validated['borrowed_at'] = date('Y-m-d H:i:s', strtotime($validated['borrowed_at']));
        }
        if (isset($validated['due_date'])) {
            $validated['due_date'] = date('Y-m-d H:i:s', strtotime($validated['due_date']));
        }

        $loan = Loan::create($validated);

        return response()->json([
            'data' => $loan,
            'message' => 'Loan created successfully',
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'message' => 'Loan not found',
            ], 404);
        }

        return response()->json([
            'data' => $loan,
            'message' => 'Loan retrieved successfully',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'message' => 'Loan not found',
            ], 404);
        }

        $validated = $request->validate([
            'borrower_name' => 'sometimes|string|max:255',
            'borrower_email' => 'sometimes|email|max:255',
            'book_title' => 'sometimes|string|max:255',
            'borrowed_at' => 'sometimes|date',
            'due_date' => 'sometimes|date|after:borrowed_at',
            'returned' => 'sometimes|boolean',
            'status' => 'sometimes|in:active,returned,overdue',  
        ]);

        $loan->update($validated);

        return response()->json([
            'data' => $loan,
            'message' => 'Loan updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'message' => 'Loan not found',
            ], 404);
        }

        $loan->delete();

        return response()->json([
            'message' => 'Loan deleted successfully',
        ], 204);
    }

        public function patched(string $id)
    {
        $loan = Loan::find($id);

        if (!$loan){
            return response()->json([
                'message' => 'Loan not found',
            ], 404);
        }

        $loan->returned = TRUE;
        $loan->save();

        return response()->json([
            'data'  => $loan,
            'message' => 'Loan marked as returned'
        ], 200);  
    }

}
