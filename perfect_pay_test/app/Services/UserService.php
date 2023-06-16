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


    /**
     * @param int $id
     * @param float $value
     * @return array
     */
    public function checkIfHaveEnoughBalance(int $id, float $value):array
    {
        $user = $this->find($id,true);

        if (($user->balance - $value) < 0 ){
            return ['error' => true, 'message' => 'sem saldo suficiente'];
        }
        return $user;
    }

    /**
     * @param int $id
     * @param float $value
     * @param bool $revert
     * @return array
     */
    public function withdrawBalance(int $id, float $value, bool $revert = false):array
    {
        $user          = $this->find($id,true);
        $balance_old   = $user->balance;
        $user->balance = $balance_old - $value;
        $user->save();
        return ['balance_prior_to_payer_transfer' => $balance_old];
    }

    /**
     * @param int $id
     * @param float $value
     * @return array
     */
    public function receiveBalance(int $id, float $value):array
    {
        $user          = $this->find($id,true);
        $balance_old   = $user->balance;
        $user->balance = $balance_old + $value;
        $user->save();
        return ['balance_prior_to_transfer_from_recipient' => $balance_old];
    }






}
