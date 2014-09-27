<?php

/*
 * ------------------------ METHODS WITH AUTHENTICATION ------------------------
 */

/**
 * Listing all tasks of particular user
 * method GET
 * url /tasks
 */
$app->get('/', function () use ($app) {
    global $user_id;
    $response = array();
    $taskModel = new Task();

    // fetching all user tasks
    $tasks = $taskModel->getAllUserTasks($user_id);

    $response['error'] = false;
    $response['tasks'] = array();

    // looping through result and preparing tasks array
    foreach ($tasks as $task) {
        $tmp = array();
        $tmp['id'] = $task['id'];
        $tmp['task'] = $task['task'];
        $tmp['status'] = $task['status'];
        $tmp['createdAt'] = $task['created_at'];
        array_push($response['tasks'], $tmp);
    }

    Response::echoRespnse(200, $response);
});

/**
 * Listing single task of particular user
 * method GET
 * url /tasks/:id
 * Will return 404 if the task doesn't belongs to user
 */
$app->get('/:id', function ($task_id) use ($app) {
    global $user_id;
    $response = array();
    $taskModel = new Task();

    // fetch task
    $result = $taskModel->getTask($task_id, $user_id);

    if ($result != NULL) {
        $response['error'] = false;
        $response['id'] = $result['id'];
        $response['task'] = $result['task'];
        $response['status'] = $result['status'];
        $response['createdAt'] = $result['created_at'];
        Response::echoRespnse(200, $response);
    } else {
        $response['error'] = true;
        $response['message'] = "The requested resource doesn't exists";
        Response::echoRespnse(404, $response);
    }
});

/**
 * Creating new task in db
 * method POST
 * params - name
 * url - /tasks/
 */
$app->post('/', function () use ($app) {
    // check for required params
    Validators::verifyRequiredParams(array('task'));

    $response = array();
    $task = $app->request->post('task');

    global $user_id;
    $taskModel = new Task();

    // creating new task
    $task_id = $taskModel->createTask($user_id, $task);

    if ($task_id != NULL) {
        $response['error'] = false;
        $response['message'] = "Task created successfully";
        $response['task_id'] = $task_id;
        Response::echoRespnse(201, $response);
    } else {
        $response['error'] = true;
        $response['message'] = "Failed to create task. Please try again";
        Response::echoRespnse(200, $response);
    }
});

/**
 * Updating existing task
 * method PUT
 * params task, status
 * url - /tasks/:id
 */
$app->put('/:id', function ($task_id) use ($app) {
    // check for required params
    Validators::verifyRequiredParams(array('task', 'status'));

    global $user_id;
    $task = $app->request->put('task');
    $status = $app->request->put('status');

    $taskModel = new Task();
    $response = array();

    // updating task
    $result = $taskModel->updateTask($user_id, $task_id, $task, $status);
    if ($result) {
        // task updated successfully
        $response['error'] = false;
        $response['message'] = "Task updated successfully";
    } else {
        // task failed to update
        $response['error'] = true;
        $response['message'] = "Task failed to update. Please try again!";
    }
    Response::echoRespnse(200, $response);
});

/**
 * Deleting task. Users can delete only their tasks
 * method DELETE
 * url /tasks
 */
$app->delete('/:id', function ($task_id) use ($app) {
    global $user_id;

    $taskModel = new Task();
    $response = array();
    $result = $taskModel->deleteTask($user_id, $task_id);
    if ($result) {
        // task deleted successfully
        $response['error'] = false;
        $response['message'] = "Task deleted successfully";
    } else {
        // task failed to delete
        $response['error'] = true;
        $response['message'] = "Task failed to delete. Please try again!";
    }
    Response::echoRespnse(200, $response);
});