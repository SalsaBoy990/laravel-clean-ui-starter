<?php

namespace App\Interface\Repository\Job;

use App\Models\Job\Job;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface JobRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getJobs(): Collection;


    /**
     * @param  int  $jobId
     * @return Job
     */
    public function getJobById(int $jobId): Model;


    /**
     * @param  Job  $job
     * @param  array  $data
     * @param  array  $workerIds
     * @return Job
     */
    public function updateJob(Job $job, array $data, array $workerIds): Job;


    /**
     * @param  array  $data
     * @param  array  $workerIds
     * @return Job
     */
    public function createJob(array $data, array $workerIds): Job;


    /**
     * @param  Job  $job
     * @return void
     */
    public function deleteJob(Job $job): void;

}
