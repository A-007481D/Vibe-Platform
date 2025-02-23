<?php

namespace App\Http\Controllers;

use App\Services\UserSearchService;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    protected UserSearchService $userSearchService;
    public function __construct(UserSearchService $userSearchService){
        $this->userSearchService = $userSearchService;
    }

    /**
     * handle the user  search request
     */
    public function index(Request $request) {
        $search = $request->search;
        $users = $this->userSearchService->searchUsers($search);
        return view('search-results', compact('users', 'search'));
    }
}
