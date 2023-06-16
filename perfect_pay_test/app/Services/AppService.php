<?php

namespace App\Services;

use App\AppHelper;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

/**
 * AppService
 */
class AppService
{
    protected $repository;

    /**
     * @param int $limit
     * @return mixed
     */
    public function all(int $limit = 20)
    {
        return $this->repository->paginate($limit);
    }

    /**
     * @param array $data
     * @param bool $skipPresenter
     * @return mixed
     */
    public function create(array $data, bool $skipPresenter = false)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $skipPresenter ? $this->repository->skipPresenter()->create($data) : $this->repository->create($data);
    }

    /**
     * @param $id
     * @param bool $skip_presenter
     * @return mixed
     */
    public function find($id, bool $skip_presenter = false)
    {
        if ($skip_presenter) {
            return $this->repository->skipPresenter()->find($id);
        }
        return $this->repository->find($id);
    }

    /**
     * @param array $data
     * @param $id
     * @param bool $skipPresenter
     * @return array|mixed
     */
    public function update(array $data, $id, bool $skipPresenter = false)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $skipPresenter ? $this->repository->skipPresenter()->update($data, $id) : $this->repository->update(
            $data,
            $id
        );
    }

    /**
     * @param array $data
     * @param bool $first
     * @param bool $presenter
     * @return mixed
     */
    public function findWhere(array $data, bool $first = false, bool $presenter = false)
    {
        if ($first) {
            return $this->repository->skipPresenter()->findWhere($data)->first();
        }
        if ($presenter) {
            return $this->repository->findWhere($data);
        }
        return $this->repository->skipPresenter()->findWhere($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findLast(array $data)
    {
        return $this->repository->skipPresenter()->findWhere($data)->last();
    }

    /**
     * Remove the specified resource from storage using softDelete.
     * =
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return ['success' => (boolean)$this->repository->delete($id)];
    }


    /**
     * @return array|null
     */
    public function getUserLogged():?array
    {
        $user_authenticated = Auth::user();
        return [
            'id'    => $user_authenticated->id,
            'name'  => $user_authenticated->name,
            'email' => $user_authenticated->email,
        ];
    }


    /**
     * @param $value
     * @return string
     */
    public function removeSpaces($value): string
    {
        return AppHelper::removeSpaces($value);
    }

    /**
     * @param $value
     * @return array|string|string[]|null
     */
    public function removeSpecialCharacters($value):array|string|null
    {
        return AppHelper::removeSpecialCharacters($value);
    }

    /**
     * @param $value
     * @return string|array|null
     */
    public function removeAccentuation($value): string|array|null
    {
        return AppHelper::removeAccentuation($value);
    }

    /**
     * @param $date
     * @return false|string
     */
    public function formatDateDB($date): false|string
    {
        return AppHelper::formatDateDB($date);
    }

    /**
     * @param $value
     * @return int|null
     */
    public function getAgeByDateBirth($value): ?int
    {
        return AppHelper::getAgeByDateBirth($value);
    }

    /**
     * @return Client
     */
    protected function getHttpClient(): Client
    {
        return new Client(['verify' => false]);
    }

    /**
     * @param string $string
     * @return string
     */
    public function clearCharacters(string $string): string
    {
        $string = str_replace(' ', '', $string);
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}
