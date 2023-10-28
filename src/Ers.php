<?php

namespace Horaceho\Ers;

/**
 * Ratings are updated by: r' = r + con * (Sa - Se) + bonus
 *
 * r is the old EGD rating (GoR) of the player
 * r' is the new EGD rating of the player
 * Sa is the actual game result (1.0 = win, 0.5 = jigo, 0.0 = loss)
 * Se is the expected game result as a winning probability (1.0 = 100%, 0.5 = 50%, 0.0 = 0%). See further below for its computation.
 * con is a factor that determines rating volatility (similar to K in regular Elo rating systems): con = ((3300 - r) / 200)^1.6
 * bonus (not found in regular Elo rating systems) is a term included to counter rating deflation: bonus = ln(1 + exp((2300 - rating) / 80)) / 5
 * Se is computed by the Bradley-Terry formula: Se = 1 / (1 + exp(β(r2) - β(r1)))
 * r1 is the EGD rating of the player
 * r2 is the EGD rating of the opponent
 * β is a mapping function for EGD ratings: β = -7 * ln(3300 - r)
 *
 * https://www.europeangodatabase.eu/EGD/EGF_rating_system.php
 */

class Ers
{
    /**
     * Calculate updated rating of player
     *
     * @param  float  $player
     * @param  float  $opponent
     * @param  float  $result
     * @return float
     */
    public function update(
        $player,
        $opponent,
        $result,
        $con_div = 200.0,
        $con_pow = 1.6,
    ) {
        $con = $this->con($player, $con_div, $con_pow);
        $sa = $result;
        $se = $this->expect($player, $opponent);
        $bonus = $this->bonus($player);

        $result = $player + $con * ($sa - $se) + $bonus;

        return round($result, 3);
    }

    /**
     * Determinate rating volatility
     *
     * @param  float  $rating
     * @return float
     */
    public function con($rating, $div = 200.0, $pow = 1.6)
    {
        $con = pow(((3300.0 - $rating) / $div), $pow);
        return $con;
    }

    /**
     * Calculate expected winning probability by the Bradley-Terry formula
     *
     * @param  float  $player
     * @param  float  $opponent
     * @return float
     */
    public function expect($player, $opponent)
    {
        $expect = 1.0 / (1 + exp($this->beta($opponent) - $this->beta($player)));
        return $expect;
    }

    /**
     * Mapping function
     *
     * @param  float  $rating
     * @return float
     */
    public function beta($rating)
    {
        $beta = -7.0 * log(3300.0 - $rating);
        return $beta;
    }

    /**
     * Counter rating deflation
     *
     * @param  float  $rating
     * @return float
     */
    public function bonus($rating)
    {
        $bonus = log(1 + exp((2300.0 - $rating) / 80.0)) / 5.0;
        return $bonus;
    }

    /**
     * About
     *
     * @return string
     */
    public function about() {
        return "ERS (EGF Rating System)";
    }
}
