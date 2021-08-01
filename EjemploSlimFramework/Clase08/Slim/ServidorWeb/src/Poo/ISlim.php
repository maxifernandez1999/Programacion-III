<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

interface ISlim
{
    function GetAll(Request $request, Response $response, array $args) : Response;
    function GetOne(Request $request, Response $response, array $args) : Response;
    function Add(Request $request, Response $response, array $args) : Response;
    function Modify(Request $request, Response $response, array $args) : Response;
    function Delete(Request $request, Response $response, array $args) : Response;
}