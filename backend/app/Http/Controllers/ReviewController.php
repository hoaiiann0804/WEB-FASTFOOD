<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'product_id' => 'required|integer', // ví dụ: product_id là bắt buộc và là số nguyên
            'name' => 'required|string',
            'email' => 'required|email',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5', // rating từ 1 đến 5
        ]);

        try {
            // Create a new review instance
            $review = new Review();

            // Assign values from the validated data
            $review->product_id = $validatedData['product_id'];
            $review->name = $validatedData['name'];
            $review->email = $validatedData['email'];
            $review->review = $validatedData['review'];
            $review->rating = $validatedData['rating'];

            // Save the review to the database
            $review->save();

            // Return a success response
            return response()->json(['message' => 'Review created successfully'], 201);
        } catch (\Exception $e) {
            // Handle any errors that occur during saving
            return response()->json(['message' => 'Failed to store review', 'error' => $e->getMessage()], 500);
        }
    }
}
