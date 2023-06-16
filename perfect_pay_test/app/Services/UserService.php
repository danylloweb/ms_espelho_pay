<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Enums\UserTypeEnum;
use App\Repositories\UserRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * UserService
 */
class UserService extends AppService
{
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param int $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function all(int $limit = 20)
    {
        return $this->repository
            ->resetCriteria()
            ->pushCriteria(app(AppRequestCriteria::class))
            ->paginate($limit);
    }

    /**
     * @param array $data
     * @param bool $skipPresenter
     * @return mixed
     */
    public function create(array $data, bool $skipPresenter = false)
    {
        if (strlen($data['cpf_cnpj']) <= 11) {
            $data['user_type_id'] = UserTypeEnum::PERSON;
        } else {
            $data['user_type_id'] = UserTypeEnum::COMPANY;
        }
         return parent::create($data);
    }

}
